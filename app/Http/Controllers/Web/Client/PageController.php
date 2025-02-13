<?php

namespace App\Http\Controllers\Web\Client;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CampaignDetails;
use App\Models\Signage;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Tutorial;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;


class PageController extends Controller
{
    public function tutorials()
    {
        $tutorials = Tutorial::where('section', 'user')->get();
        return view('client.layouts.tutorial', compact('tutorials'));
    }

    public function profile()
    {
        return view('client.layouts.profile');
    }

    public function invoiceList()
    {
        return view('client.layouts.invoice-list');
    }

    public function invoice()
    {
        return view('client.layouts.invoice');
    }

    public function newCampaigns(Request $request)
    {
        if ($request->ajax()) {
            $query = Signage::query();
            
            // Filter by city
            if ($request->has('city') && !empty($request->city)) {
                $query->where('location', $request->city);
            }
    
            // Filter by category
            if ($request->has('category') && !empty(trim($request->category))) {
                $query->where('category_name', $request->category);
            }
    
            // Get the filtered signages
            $signages = $query->get();
    
            // Return JSON response with filtered signages and cities
            $cities = Signage::select('location')->distinct()->get(); // Get unique cities
    
            return response()->json([
                'signages' => $signages,
                'cities' => $cities
            ]);
        }
    
        // Normal page load
        $signages = Signage::take(20)->get(); // You can limit the number of results for better performance
        $categories = Category::all();
        $cities = Signage::select('location')->distinct()->get(); // Get unique cities
        
        return view('client.layouts.new-campaigns', compact('signages', 'categories', 'cities'));
    }
    

    public function billing()
    {
        return view('client.layouts.billing');
    }

    public function cart()
    {
        return view('client.layouts.cart');
    }

    public function startedForm()
    {
        return view('client.layouts.get-started-form');
    }

    // for detact location according to lat and lan
    public function getLocation($id)
    {
        try {
            $signage = Signage::find($id);
            if (!$signage) {
                return response()->json(['error' => 'Signage not found'], 404);
            }
            return response()->json([
                'name' => $signage->name,
                'signage_id' => $signage->id,
                'location' => $signage->location,
                'type' => $signage->type,
                'price_per_day' => $signage->per_day_price,
                'rotation_time' => $signage->rotation_time,
                'total_views' => $signage->total_views,
                'category_name' => $signage->category_name,
                'avg_daily_views' => $signage->avg_daily_views
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
    //store 

    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'subtotal' => 'required|numeric',
            'dispatchFee' => 'required|numeric',
            'total' => 'required|numeric',
            'addTitle' => 'nullable|string',
            'description' => 'nullable|string',
            'art_work' => 'nullable|string',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'artWork' => 'nullable|string',
        ]);

        // Start transaction to ensure atomicity
        DB::beginTransaction();

        try {
            // Generate short UUID
            $shortUuid = $this->generateShortUuid(5);
            // Create the order
            $order = Order::create([
                'user_id' => auth()->id(),
                'uuid' => $shortUuid,
                'subtotal' => $request->subtotal,
                'dispatch_fee' => $request->dispatchFee,
                'total' => $request->total,
                'status' => 'pending',
            ]);

             // Handle Base64 image (artWork)
        $artWorkUrl = null;
        if ($request->artWork) {
          
            $artWorkUrl = Helper::saveBase64Image($request->artWork);
        }

            CampaignDetails::create([
                'order_id' => $order->id,
                'ad_title' => $request->addTitle ?? '',
                'campaign_description' => $request->description ?? '',
                'start_date' => $request->startDate ,
                'end_date' => $request->endDate ,
                'art_work' => $artWorkUrl
            ]);
       
            // Add order items
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'signage_id' => $item['signage_id'],
                    'price_per_day' => $item['price_per_day'],
                    'rotation_time' => $item['rotation_time'],
                    'avg_daily_views' => $item['avg_daily_views'],
                    'total' => $item['total'],
                ]);
            }


            DB::commit();

            Log::info("Order placed successfully");

            return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
        } catch (\Exception $e) {

            DB::rollback();

            Log::error('Error placing order: ' . $e->getMessage());

            return response()->json(['message' => 'Error placing order'], 500);
        }
    }



    private function generateShortUuid($length = 5)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Letters and Numbers
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}



 