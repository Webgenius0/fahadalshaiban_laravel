<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Signage;
use Illuminate\Support\Facades\DB;

class CampaignDetailsController extends Controller
{
    public function getBookingDetails($id)
    {
        // $campaignDetail = CampaignDetails::find($campaignDetailId);
        $orders = DB::table('signages as s')
    ->join('order_items as oi', 's.id', '=', 'oi.signage_id')  // Join order_items on signage_id
    ->join('campaign_details as cd', 'oi.order_id', '=', 'cd.order_id')  // Join campaign_details on order_id
    ->join('orders as o', 'oi.order_id', '=', 'o.id')  // Join orders on order_id
    ->select('s.*', 'oi.*', 'cd.*', 'o.*')  // Select all fields from the joined tables
    ->where('oi.signage_id', '=', DB::raw('s.id'))  // Ensure order_items.signage_id = signages.id
    ->where('o.id', '=', $id)  // Filter by the specific order ID
    ->get();

    


        // return view('client.campaign-details.booking-details', compact('campaignDetail', 'orders'));
        return view('client.layouts.campaign_details', compact('orders'));
    }
}
