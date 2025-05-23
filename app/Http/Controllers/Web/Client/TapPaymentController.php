<?php

namespace App\Http\Controllers\Web\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Signage;
use App\Models\BillingAddress;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TapPaymentController extends Controller
{

    public function index()
    {
        return view('tap');
    }
    public function createMerchant()
    {
        $client = new Client();
        $url = "https://api.tap.company/v2/merchants/";
        $data = [
            "display_name" => "fahadalshaiban",
            "business_id" => "bus_uITwK4822102a8ye23cB9g556",
            "business_entity_id" => "ent_iDTwK4822102vRLG239U9h562",
            "brand_id" => "brd_p0TwK322103Il27234M9h207",
            "branch_id" => "brc_oETwK322103Om1s23Oa9R301",
            "wallet_id" => "wal_vlTwK4822102vK0s23Up9M562",
            "charge_currencies" => ["KWD"],
            "bank_account" => [
                "iban" => "INBNK00045545555555555555"
            ],
            "settlement_by" => "Bank"
        ];
        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('TAP_SECRET_KEY'),
                    'Accept' => 'application/json',
                    'content-type' => 'application/json'
                ],
                'json' => $data
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            return response()->json($result);
        } catch (Exception $e) {
            Log::error('Create merchant exception: ' . $e->getMessage());
            return response()->json(['error' => 'Create merchant exception'], 500);
        }
    }

    public function createCharge($order_id)
    {
   
        $service_charge = 0; 
        $total_price = 0;
        $destinations = collect();
        $billingaddress=BillingAddress::where('order_id',$order_id)->first();
        $order_itmes = OrderItem::where('order_id', $order_id)->get();

        foreach ($order_itmes as $item) {
            $user = User::find($item->owner_id);
            $ownerprice = $item->owner_profit; 
            $service_charge += $item->admin_profit;
            $total_price += $item->owner_profit + $item->admin_profit;
            $destinations->push(['id' => $user->tap_marcent_id, 'amount' => $ownerprice, 'currency' => 'KWD']);
        }
        
        $destinations->push(['id' => env('TAP_MERCHANT_ID'), 'amount' => $service_charge, 'currency' => 'KWD']);


        $client = new Client();
        $url = "https://api.tap.company/v2/charges/";

        $data = [
            "amount" => $total_price,
            "currency" => "SAR",
            "metadata" => [
                'title' => 'payment'
            ],
            "customer" => [
                "first_name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "phone" => [
                    "country_code" => "+11",
                    "number" => $billingaddress->phone,
                ]
            ],
            "source" => [
                "id" => "src_all"
            ],
            "destinations" => $destinations,
            "redirect" => [
                "url" => route('payment.callback')
            ]
        ];
        try {
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('TAP_SECRET_KEY'),
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
                'json' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return redirect()->away($result['transaction']['url']);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Payment failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function paymentCallback(Request $request)
    {
        $charge_id = $request->input('tap_id');
        $client = new Client();
        $url = "https://api.tap.company/v2/charges/" . $charge_id;
        try {
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('TAP_SECRET_KEY'),
                    'Accept' => 'application/json',
                    'content-type' => 'application/json'
                ],
            ]);
            $result = json_decode($response->getBody(), true);
            return $this->paymentSuccess($result);
        } catch (Exception $e) {
            Log::error('Payment callback exception: ' . $e->getMessage());
            return response()->json(['error' => 'Payment callback exception'], 500);
        }
    }

    public function paymentSuccess($data)
    {
        if (!auth('web')->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $order = Order::where('user_id', auth('web')->user()->id)
                      ->latest()  
                      ->first(); 
    
        // Check if the order exists
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
    
        // Update the order with the payment data
        $order->update([
            'status' => 'booked',  
            // 'uuid' => Str::random(5), 
            'subtotal' => $data['subtotal'] ?? $order->subtotal,  
            'dispatch_fee' => $data['dispatch_fee'] ?? $order->dispatch_fee,  
            'total' => $data['total'] ?? $order->total,  
            'payment_status' => 'booked',  
        ]);
    
        // Return a success response
        // return response()->json(['message' => 'Order Plased successfully', 'order' => $order], 200);
        return view('client.layouts.success');

        
    }

    public function paymentFailed($data)
    {
        if (!auth('web')->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $order = Order::where('user_id', auth('web')->user()->id)
                      ->latest()  
                      ->first(); 
    
        // Check if the order exists
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
    
        // Update the order with the payment data
        $order->update([
            'status' => 'cancelled',  
            
        ]);
    
        // Return a success response
        return response()->json(['message' => 'Order Failed', 'order' => $order], 200);
    }
}
