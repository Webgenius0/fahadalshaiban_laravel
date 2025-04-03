<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use App\Models\Signage;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
       
        // $orders = DB::table('orders')
        // ->join('campaign_details', 'orders.id', '=', 'campaign_details.order_id')
        // ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        // ->join('signages', 'order_items.signage_id', '=', 'signages.id')
        // ->where('orders.user_id', auth('web')->user()->id)  // Make sure to filter by the user's ID
        // ->select('orders.*', 'campaign_details.*','signages.*')  // Select the columns you want from both tables
        // ->orderBy('orders.created_at', 'desc') 
        // ->paginate(9);
        // return view('client.layouts.dashboard', compact('orders'));

        $totalOrders = DB::table('orders')
        ->join('campaign_details', 'orders.id', '=', 'campaign_details.order_id')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('signages', 'order_items.signage_id', '=', 'signages.id')
        ->where('orders.user_id', auth('web')->user()->id)  // Filter by the user's ID
        ->count();  // Get the total number of orders

$orders = DB::table('orders')
        ->join('campaign_details', 'orders.id', '=', 'campaign_details.order_id')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('signages', 'order_items.signage_id', '=', 'signages.id')
        ->where('orders.user_id', auth('web')->user()->id)  // Filter by the user's ID
        ->select('orders.*', 'campaign_details.*', 'signages.*')  // Select the columns you want
        ->orderBy('orders.created_at', 'desc') 
        ->paginate(9);

return view('client.layouts.dashboard', compact('orders', 'totalOrders'));



    }

    public function getsignages()
    {
        $signages = Signage::where('status', 'active')->get();
            
       return view('client.layouts.new-campaigns', compact('signages'));
    }
}
