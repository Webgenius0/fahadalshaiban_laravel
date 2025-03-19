<?php

namespace App\Http\Controllers\Web\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Order;
class IncomeStatementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            //     ->join('signages', 'signages.id', '=', 'order_items.signage_id')
            //     ->join('campaign_details', 'orders.id', '=', 'campaign_details.order_id')
            //     ->where('signage.user_id', auth()->user()->id)
            //     ->select('order_items.*', 'campaign_details.*', 'signages.*', 'orders.*')
            //     ->get();
            $data = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('signages', 'signages.id', '=', 'order_items.signage_id')
            ->join('campaign_details', 'orders.id', '=', 'campaign_details.order_id')
            ->where('signages.user_id', auth()->user()->id) // Filter by signages table's user_id
            ->select('order_items.*', 'campaign_details.*', 'signages.*', 'orders.*')
            ->where('orders.payment_status', 'booked')
            ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('art_work', function ($data) {
                    if ($data->image) {
                        $url = asset($data->art_work);
                        return '<img src="' . $url . '" alt="image" width="50px" height="50px" style="margin-left:20px; border-radius: 50%;">';
                    } else {
                        return '<img src="' . asset('default/logo.png') . '" alt="image" width="50px" height="50px" style="margin-left:20px;">';
                    }
                })
                ->addColumn('exposure_time',function($data0){
                    return $data0->exposure_time ." "."second per a minute";
                })
                ->addColumn('status', function ($data) {
                    $backgroundColor = $data->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->status == "active" ? '26px' : '2px';
                    $sliderStyles = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                    $status = '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="' . $sliderStyles . '"></span>';
                    $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group">
                                <a href="' . route('owner.owner.income-statement-pdf', $data->id) . '" 
                                   class="btn btn-success fs-14 text-white" 
                                   title="Download">
                                    Download
                                </a>
                            </div>';
                })
                ->rawColumns(['image', 'status', 'action', 'art_work'])
                ->make();
        }
        return view("owner.layouts.income-statement-list");
    }

    
}
