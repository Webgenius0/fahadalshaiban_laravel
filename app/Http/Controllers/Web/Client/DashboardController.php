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
       
        $orders = DB::table('orders')
        ->join('campaign_details', 'orders.id', '=', 'campaign_details.order_id')
        ->where('orders.user_id', auth('web')->user()->id)  // Make sure to filter by the user's ID
        ->select('orders.*', 'campaign_details.*')  // Select the columns you want from both tables
      
        ->get();
        return view('client.layouts.dashboard', compact('orders'));
    }
}
