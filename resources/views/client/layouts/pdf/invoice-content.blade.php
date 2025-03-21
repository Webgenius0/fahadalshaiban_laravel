@php
    $subtotal = 0;
    $firstOrder = $orders->first();
@endphp

<div class="row">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div>
            <img src="{{ public_path('/frontend/images/favicon.png') ?? 'No Image' }}" alt="Logo" style="width: 80px; height: auto; float: right;">
                <h1 class="invoice-title">Invoice</h1>
                @if ($orders->count() > 0)
                    <p>Invoice Number: <span id="invoice-number">#{{$orders->first()->uuid}}</span></p>
                @endif
            </div>

            
        </div>
    </div>

<div class="invoice-info">
    <div class="invoice-info-box">
        <p><strong style="font-size: 14px">Billed to</strong></p>
        <p>{{ $firstOrder->name?? '' }}<br>{{ $firstOrder->email?? '' }}</p>
    </div>
    <div class="invoice-info-box">
        <p><strong style="font-size: 14px">Due Date</strong></p>
        <p >{{\Carbon\Carbon::parse($firstOrder->end_date)->format('j F, y') ?? '' }}</p>
    </div>
    <div class="invoice-info-box">
        <p><strong style="font-size: 14px">Address</strong></p>
        <p>{{ $firstOrder->city ?? '' }}, {{ $firstOrder->state ?? '' }}, {{ $firstOrder->country ?? '' }}</p>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Location</th>
            <th>Days</th>
            <th>Price/Day</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        @php
            $start = \Carbon\Carbon::parse($order->start_date ?? '') ;
            $end = \Carbon\Carbon::parse($order->end_date ?? '');
            $days = $start->diffInDays($end ?? '');
            $total = $order->price_per_day * $days;           
            $subtotal += $total;
            $totalwithtax =$total * (env('DESPATCH_FEE')/100)+$subtotal;
        @endphp
        <tr>
            <td>{{ $order->uuid }}</td>
            <td>{{ $order->location }}</td>
            <td>{{ $days }}</td>
            <td>{{ number_format($order->price_per_day, 2) }} <img src="{{ public_path('currency/realcurrency.png') }}" class="currency-img"></td>
            <td>{{ number_format($total, 2) }} <img src="{{ public_path('currency/realcurrency.png') }}" class="currency-img"></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top: 30px; margin-top: 15px;">
    <table style="width: 300px; float: right; margin-top: 15px; border-radius: 5px;">
        <tr>
            <th>Subtotal:</th>
            <td>{{ number_format($subtotal, 2) }} <img src="{{ public_path('currency/realcurrency.png') }}" class="currency-img"></td>
        </tr>
        <tr>
            <th>Discount:</th>
            <td>0.00</td>
        </tr>
        <tr>
            <th>Tax:</th>
            <td>{{env('DESPATCH_FEE')}}%</td>
        </tr>
        
        <tr>
            <th>Total:</th>
            <td>{{ number_format($totalwithtax, 2) }} <img src="{{ public_path('currency/realcurrency.png') }}" class="currency-img"></td>
        </tr>
    </table>
</div>
