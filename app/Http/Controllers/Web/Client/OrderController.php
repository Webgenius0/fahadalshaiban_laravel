<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

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
        $order->status = 'pending';  // Default status
        $order->save();  // Save the order to the database
    
        // Now, create the order items
        foreach ($orderData['items'] as $item) {
            $order->items()->create([
                'signage_id' => $item['signage_id'],
                'name' => $item['name'],
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
            ->where('status', 'completed')
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
    public function getBookedDates($orderId)
{
    // Fetch the order by ID for the authenticated user
    $order = Order::where('id', $orderId)
                  ->where('user_id', auth('web')->user()->id)  // Ensure the order belongs to the current user
                  ->first();

    // Check if the order exists and belongs to the current user
    if (!$order) {
        return response()->json(['error' => 'Order not found or not authorized'], 403);
    }

    // Assume the booked dates are stored in a related table 'bookings'
    // and you have a 'booking_date' column
    $bookedDates = $order->bookings()->pluck('booking_date');  // Adjust this according to your table structure

    // Return the booked dates in a response
    return response()->json(['bookedDates' => $bookedDates]);
}

}
