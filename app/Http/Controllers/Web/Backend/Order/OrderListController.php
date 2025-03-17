<?php

namespace App\Http\Controllers\Web\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Contactus;

class OrderListController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
           
            $data = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('campaign_details', 'orders.id', '=', 'campaign_details.order_id')
            ->join('signages', 'signages.id', '=', 'order_items.signage_id')
            ->select('orders.*', 'order_items.*', 'campaign_details.*', 'signages.*', 'orders.user_id') 
             
            ->get();

            
            return DataTables::of($data)
                ->addIndexColumn()
                // ->addColumn('uuid', function ($row) {
                //     // Check if orders exist and concatenate all uuids
                //     return $row->orders->isNotEmpty() ? $row->orders->pluck('uuid')->implode(', ') : 'No UUID';
                // })
                // ->addColumn('ad_title', function ($row) {
                //     // Check if orders exist and get the first order's uuid
                //     return $row->campaignDetails->isNotEmpty() ? $row->campaignDetails->first()->ad_title : 'No UUID';
                // })
                ->addColumn('image', function ($data) {
                    if ($data->image) {
                        $url = asset($data->image);
                        return '<img src="' . $url . '" alt="image" width="50px" height="50px" style="margin-left:20px; border-radius: 50%;">';
                    } else {
                        return '<img src="' . asset('default/logo.png') . '" alt="image" width="50px" height="50px" style="margin-left:20px;">';
                    }
                })
                ->addColumn('status', function ($data) {              
                    $backgroundColor = '#ccc';
                    $sliderTranslateX = '2px';
                    $statusText = '';
                    $statusLabel = '';
                
                    if ($data->payment_status == 'booked') {
                        $backgroundColor = '#4CAF50';
                        $sliderTranslateX = '26px'; 
                        $statusText = '';
                    } elseif ($data->payment_status == 'pending') {
                        $backgroundColor = '#e0d60b'; 
                        $sliderTranslateX = '2px'; 
                        $statusText = '<span style="color: red; font-size: 10px; position: absolute; top: 4px; left: 8px;">Pending</span>';
                    } elseif ($data->payment_status == 'cancelled') {
                        $backgroundColor = '#FF5722'; 
                        $sliderTranslateX = '2px'; 
                        $statusLabel = '<span style="color: #fff; font-size: 10px; position: absolute; top: 4px; left: 8px;">Cancelled</span>';
                    }
                
                    // Slider style definition
                    $sliderStyles = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";
                
                    // Construct the HTML for the status switch button
                    $status = '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="' . $sliderStyles . '"></span>';
                    $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                    $status .= $statusText . $statusLabel;
                    $status .= '</div>';
                
                    return $status;
                })
                
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="#" type="button" onclick="showView(' . $data->id . ')" class="btn btn-success fs-14 text-white " title="View">
                                   <i class="fe fe-eye"></i>
                                </a>
                            </div>';
                })
                ->rawColumns([ 'status', 'action', 'image'])
                ->make(true);
        }
    
        return view('backend.layouts.order.order-list');
    }

}
