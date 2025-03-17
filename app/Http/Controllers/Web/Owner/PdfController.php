<?php

namespace App\Http\Controllers\Web\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
class PdfController extends Controller
{
    public function generateIncomeStatement($id)
    {
       
        $data = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('signages', 'signages.id', '=', 'order_items.signage_id')
            ->join('campaign_details', 'orders.id', '=', 'campaign_details.order_id')
            ->where('signages.user_id', auth()->user()->id) 
            ->where('orders.id', $id) 
            ->select('order_items.*', 'campaign_details.*', 'signages.*', 'orders.*')
            ->first(); 
    
        if (!$data) {
            abort(404, 'Data not found');
        }

        $user = auth()->user();

        $pdf = PDF::loadView('owner.layouts.pdf.income-statement', compact('data', 'user'));

        return $pdf->download('income_statement_' . $id . '.pdf');
    }

    // download all statement
    public function downloadAll()
    {
    $orders = Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->join('signages', 'signages.id', '=', 'order_items.signage_id')
        ->join('campaign_details', 'orders.id', '=', 'campaign_details.order_id')
        ->where('signages.user_id', auth()->user()->id) 
        ->select('order_items.*', 'campaign_details.*', 'signages.*', 'orders.*')
        ->get(); 

    if ($orders->isEmpty()) {
        abort(404, 'No data found');
    }
    $user = auth()->user();
    $pdfs = [];
    foreach ($orders as $order) {   
        $pdf = PDF::loadView('owner.layouts.pdf.income-statement-content', compact('order', 'user'));
        $pdfs[] = $pdf;
    }
    $combinedPdf = $pdfs[0];

    for ($i = 1; $i < count($pdfs); $i++) {
        $combinedPdf = $combinedPdf->addPage()->merge($pdfs[$i]);
    }
    return $combinedPdf->download('all_income_statements.pdf');
}
    
}
