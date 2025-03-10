<?php

namespace App\Http\Controllers\Web\Owner;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use Laravel\Pail\ValueObjects\Origin\Console;
use App\Models\CampaignDetails;
use App\Models\OrderItem;
use App\Models\Signage;
use Carbon\Carbon;
use function Laravel\Prompts\alert;
use Illuminate\Support\Facades\Auth;

class OrderListController extends Controller
{
  public function index(Request $request)
{
    if ($request->ajax()) {
        $userId = Auth::id();
        $data = Signage::with(['orderItems.orders', 'orderItems.campaignDetails'])
            ->where('user_id', $userId)
            ->get();
        dd($data);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('uuid', function ($row) {
                return $row->uuid;
            })
            ->addColumn('image', function ($data) {
                if ($data->image) {
                    $url = asset($data->image);
                    return '<img src="' . $url . '" alt="image" width="50px" height="50px" style="margin-left:20px;">';
                } else {
                    return '<img src="' . asset('default/logo.png') . '" alt="image" width="50px" height="50px" style="margin-left:20px;">';
                }
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
                return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a href="#" type="button" onclick="showView(' . $data->id . ')" class="btn btn-success fs-14 text-white " title="View">
                               <i class="fe fe-eye"></i>
                            </a>
                        </div>';
            })
            ->rawColumns(['image', 'status', 'action', 'uuid'])
            ->make(true);
    }

    return view('owner.layouts.order-list');
}

    //calender



    public function getOwnerBookedDates($signageId)
    {

        $signage = Signage::find($signageId);



        if (!$signage) {
            return response()->json(['error' => 'Signage not found'], 404);
        }


        $orderItems = OrderItem::where('signage_id', $signageId)->get();

        if ($orderItems->isEmpty()) {
            return response()->json(['error' => 'No orders found for this signage'], 404);
        }


        $bookedDates = [];


        foreach ($orderItems as $orderItem) {


            $order = Order::where('id', $orderItem->order_id)
                ->where('status', 'booked') // Ensure this is the correct user
                ->first();


            if ($order) {
                \Log::info("Found Order: " . $order->id);
            } else {
                \Log::info("No Order found for OrderItem: " . $orderItem->id);
            }

            if (!$order) {
                continue; // Skip if the order is not found or not authorized
            }

            // Fetch the associated campaign details for the order from the campaign_details table
            $campaignDetails = CampaignDetails::where('order_id', $order->id)->get();

            // Log campaign details to verify data
            \Log::info("Campaign Details for Order ID " . $order->id . ": ", $campaignDetails->toArray());

            // Loop through each campaign detail
            foreach ($campaignDetails as $detail) {
                $startDate = Carbon::parse($detail->start_date);
                $endDate = Carbon::parse($detail->end_date);

                // Log the start and end dates for debugging
                \Log::info("Start Date: " . $startDate->toDateString() . ", End Date: " . $endDate->toDateString());

                // Loop through each date in the range
                while ($startDate->lte($endDate)) {
                    $bookedDates[] = [
                        'title' => 'Booked',
                        'start' => $startDate->toDateString(), // Format as 'YYYY-MM-DD'
                        'end' => $startDate->toDateString(), // Same as start for single-day events
                        'allDay' => true,
                        'backgroundColor' => 'yellow', // Highlight in yellow
                        'borderColor' => 'yellow',
                    ];
                    $startDate->addDay(); // Move to the next day
                }
            }
        }

        // Return the booked dates in a response
        return response()->json(['bookedDates' => $bookedDates]);
    }
}
