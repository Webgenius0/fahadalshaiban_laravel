<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Signage;
class DashboardController extends Controller
{
    public function index(Request $request)
{
    if ($request->ajax()) {
        // Get data from order_items, orders, and users tables
        $data = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('users', 'order_items.owner_id', '=', 'users.id')
            ->select(
                'order_items.*', 
                'orders.*', 
                'users.*', 
                'order_items.created_at', 
                'order_items.owner_profit' 
            )
            ->where('orders.payment_status', 'booked')
            ->orderBy('order_items.created_at', 'desc')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('owner_profit', function ($data) {
                // Display the owner_profit value and transaction date below it
                $ownerProfit = number_format($data->owner_profit, 2); // Formatting the owner_profit to 2 decimal places
                $createdAt = $data->created_at ? $data->created_at->format('d F y') : 'N/A'; 

                return $ownerProfit . '<br><small>' . $createdAt . '</small>'; // Display owner_profit with the created_at below it
            })
            ->addColumn('admin_profit', function ($data) {
                // Display the admin_profit value and transaction date below it
                $adminProfit = number_format($data->admin_profit, 2);
                return $adminProfit; // Formatting the admin_profit to 2 decimal places
              
            })
            ->addColumn('image', function ($data) {
                // Check if the image exists and display the appropriate image
                if ($data->image) {
                    $url = asset($data->image);
                    return '<img src="' . $url . '" alt="image" width="50px" height="50px" style="margin-left:20px; border-radius: 50%;">';
                } else {
                    return '<img src="' . asset('default/logo.png') . '" alt="image" width="50px" height="50px" style="margin-left:20px;">';
                }
            })
            ->addColumn('status', function ($data) {
                // Status toggle switch
                $backgroundColor = $data->status == "active" ? '#4CAF50' : '#ccc';
                $sliderTranslateX = $data->status == "active" ? '26px' : '2px';
                $sliderStyles = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                $status = '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                $status .= '<input onclick="showStatusChangeAlert(' . $data->order_id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->order_id . '" getAreaid="' . $data->order_id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                $status .= '<span style="' . $sliderStyles . '"></span>';
                $status .= '<label for="customSwitch' . $data->order_id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                $status .= '</div>';

                return $status;
            })
            ->addColumn('action', function ($data) {
                // Display action buttons for editing or deleting the record
                return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                            <a href="#" type="button" onclick="goToEdit(' . $data->order_id . ')" class="btn btn-primary fs-14 text-white delete-icn" title="Edit">
                                <i class="fe fe-edit"></i>
                            </a>
                            <a href="#" type="button" onclick="showDeleteConfirm(' . $data->order_id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                <i class="fe fe-trash"></i>
                            </a>
                        </div>';
            })
            ->rawColumns(['owner_profit', 'image', 'status', 'action', 'admin_profit'])
            ->make();
    }

    return view('backend.layouts.dashboard');
}


}
