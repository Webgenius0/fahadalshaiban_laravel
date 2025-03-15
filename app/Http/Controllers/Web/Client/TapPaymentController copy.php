<?php

namespace App\Http\Controllers\Web\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Exception;

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

    public function createCharge(Request $request)
    {
        $request->validate([
            'charge'                => 'required|numeric',
            'name'                  => 'required|string',
            'email'                 => 'required|email',
            'phone_country_code'    => 'required|string',
            'phone_number'          => 'required|string',
        ]);

        $client = new Client();
        $url = "https://api.tap.company/v2/charges/";

        $data = [
            "amount" => $request->charge,
            "currency" => "USD",
            "metadata" => [
                'title' => 'payment'
            ],
            "customer" => [
                "first_name" => $request->name,
                "email" => $request->email,
                "phone" => [
                    "country_code" => $request->phone_country_code,
                    "number" => $request->phone_number
                ]
            ],
            "source" => [
                "id" => "src_all"
            ],
            "destinations" => [
                [
                    'id' => env('TAP_MERCHANT_ID'),
                    'amount' => 60,
                    'currency' => 'KWD',
                ],
                [
                    'id' => env('TAP_MERCHANT_ID'),
                    'amount' => 40,
                    'currency' => 'KWD',
                ],
            ],
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
        /* Transaction::create([
            'user_id' => auth('web')->user()->id,
            'amount' => $data['amount'],
            'charge_id' => $data['id'],
            'booking_id'        => $data['metadata']['booking_id'],
            'status' => 'success'
        ]); */
        return "success";
    }

    public function paymentFailed($data)
    {
        /* Transaction::create([
            'user_id' => auth('web')->user()->id,
            'amount' => $data['amount'],
            'charge_id' => $data['id'],
            'booking_id'        => $data['metadata']['booking_id'],
            'status' => 'failed'
        ]); */
        return "failed";
    }
}
