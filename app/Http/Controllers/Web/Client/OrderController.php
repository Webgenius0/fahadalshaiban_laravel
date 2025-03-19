<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use App\Models\CampaignDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

use function Laravel\Prompts\alert;

class OrderController extends Controller
{
    public function submitOrder(Request $request)
    {
      
        $orderData = $request->input('orderData');
       
        // Create a new order instance
        $order = new Order();
      
        $order->subtotal = $orderData['subtotal'];
        $order->despatch_fee = $orderData['despatchFee'];
        $order->total = $orderData['total'];
        $order->total_days = $orderData['total_days'];

        $order->payment_status = 'pending';  // Default status
        $order->save();  
        alert($order);
    
        // Now, create the order items
        foreach ($orderData['items'] as $item) {
            $order->items()->create([
                'signage_id' => $item['signage_id'],
                'name' => $item['name'],
                'owner_id' => $item['owner_id'],
                'admin_profit' => $item['admin_profit'],
                'owner_profit' => $item['owner_profit'],
                'location' => $item['location'],
                'category_name' => $item['category_name'],
                'price_per_day' => $item['price_per_day'],
                'rotation_time' => $item['rotation_time'],
                'avg_daily_views' => $item['avg_daily_views']
            ]);
        }
    
        // Return a success response
        return response()->json(['message' => 'Order placed successfully!', 'order' => $order]);
    }


    public function getCompletedOrders(Request $request)
    {
        // Get the currently logged-in user ID
        $userId = auth()->id();

        // Fetch completed orders along with the order items
        $orders = Order::with('orderItems')  // eager load the order items
            ->where('user_id', $userId)
            ->where('payment_status', 'booked')
            ->get(['id', 'order_date']);  // Select only necessary columns

        // Format the orders to be sent to the frontend
        $events = $orders->map(function ($order) {
            return $order->orderItems->map(function ($orderItem) use ($order) {
                return [
                    'title' => 'Board Rented',
                    'start' => $order->order_date, // Assuming order_date is in 'YYYY-MM-DD' format
                    'description' => 'Signage ID: ' . $orderItem->signage_id,
                    'board_id' => $orderItem->signage_id,
                ];
            });
        })->flatten();

        // Return the events as JSON response
        return response()->json($events);
    }


    public function index()
    {
        // Fetch only the distinct created_at dates (the days when orders were created)
        $order_dates = Order::selectRaw('DATE(created_at) as created_date')
                            ->distinct()
                            ->get();

        // Pass the dates to the view
        return view('client.layouts.order-calender', compact('order_dates'));
    }


    //for modal 
    public function getBookedDates($campaignDetailId)
    {
        
        $campaignDetail = CampaignDetails::find($campaignDetailId);

        if (!$campaignDetail) {
            return response()->json(['error' => 'Campaign detail not found'], 404);
        }
    
        // Fetch the associated order for the campaign detail
        $order = Order::where('id', $campaignDetail->order_id)
                      ->where('user_id', auth('web')->user()->id)
                      ->where('payment_status', 'booked')
                      ->first();
 
        if (!$order) {
            return response()->json(['error' => 'Order not found or not authorized'], 403);
        }

        $campaignDetails = $order->campaignDetails;

        $bookedDates = [];
        foreach ($campaignDetails as $detail) {
            $startDate = \Carbon\Carbon::parse($detail->start_date);
            $endDate = \Carbon\Carbon::parse($detail->end_date);
    
            // Loop through each date in the range
            while ($startDate->lte($endDate)) {
                if ($startDate->gte($campaignDetail->start_date) && $startDate->lte($campaignDetail->end_date)) {
                    $bookedDates[] = [
                        'title' => 'Booked', 
                        'start' => $startDate->toDateString(), 
                        'end' => $startDate->toDateString(), 
                        'allDay' => true, 
                        'backgroundColor' => 'yellow', 
                        'borderColor' => 'yellow',
                    ];
                }
                $startDate->addDay(); 
            }
        }
    
        return response()->json(['bookedDates' => $bookedDates]);
    }
}
