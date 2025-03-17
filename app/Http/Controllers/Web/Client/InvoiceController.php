<?php

namespace App\Http\Controllers\Web\Client;
// use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Signage;
use App\Models\BillingAddress;
use App\Models\CampaignDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
                ->join('signages', 'signages.id', '=', 'order_items.signage_id')
                ->join('campaign_details', 'orders.id', '=', 'campaign_details.order_id')
                ->where('orders.user_id', auth()->id())
                ->where('orders.payment_status', 'booked')
                ->select('order_items.*', 'campaign_details.*', 'signages.*', 'orders.*')
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
                                <a href="' . route('orders.download', $data->id) . '" 
                                   class="btn btn-success fs-14 text-white" 
                                   title="Download">
                                    Download
                                </a>
                            </div>';
                })
                ->rawColumns(['image', 'status', 'action', 'art_work'])
                ->make();
        }
        return view("client.layouts.invoice-list");
    }

    public function show($id)
    {

        $orders = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('campaign_details', 'orders.id', '=', 'campaign_details.order_id')
            ->join('signages', 'signages.id', '=', 'order_items.signage_id')
            ->join('billing_addresses', 'orders.id', '=', 'billing_addresses.order_id')
            ->where('orders.id', $id)
            ->where('orders.user_id', auth()->id())
            ->where('orders.status', 'active')

            ->select('orders.*', 'order_items.*', 'campaign_details.*', 'signages.*', 'billing_addresses.*')
            ->get();


        return view('client.layouts.invoice-details', compact('orders'));
    }

    // public function download(Request $request)
    // {
    //     // Get the HTML content from the form input
    //   $htmlContent = $request->input('html_content');

    // $pdf = PDF::loadHTML($htmlContent);
    // return $pdf->download('invoice.pdf');
    // }




    public function download($orderId)
    {
        $userId = auth()->id();

        $sql = " SELECT 
                o.*,                                  
                oi.*,                                
                b.*,                                 
                c.*,                                
                s.*                                 
            FROM 
                orders o
            LEFT JOIN 
                order_items oi ON oi.order_id = o.id          
            LEFT JOIN 
                signages s ON s.id = oi.signage_id             
            LEFT JOIN 
                billing_addresses b ON b.order_id = o.id         
            LEFT JOIN 
                campaign_details c ON c.order_id = o.id        
            WHERE 
                o.user_id = :userId                          
                AND o.id = :orderId                            
        ";


        $orders = collect(DB::select($sql, ['userId' => $userId, 'orderId' => $orderId]));


        $firstOrder = $orders->first();

        // Generate PDF with the fetched data
        $pdf = PDF::loadView('client.layouts.pdf.invoice', [
            'orders' => $orders
        ])
            ->setPaper('a4')
            ->setOptions([
                'isRemoteEnabled' => true,
                'isPhpEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'tempDir' => public_path(),
            'chroot' => public_path()
            ]);

        // Download the PDF
        return $pdf->download("invoice-{$firstOrder->uuid}.pdf");  // Use $firstOrder->uuid
    }
}
