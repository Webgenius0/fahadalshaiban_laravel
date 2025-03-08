@extends('client.app', ['title' => 'Campaign Details'])
@push('style')
<link rel="icon" type="image/png" href="{{ asset('frontend') }}/images/favicon.png" />
<link
    rel="stylesheet"
    type="text/css"
    href="{{ asset('frontend') }}/css/plugins/bootstrap.min.css" />

<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/plugins/nice-select.min.css" />
<link rel="stylesheet" href="{{ asset('frontend') }}/css/plugins/all.min.css" />
<link rel="stylesheet" href="{{ asset('frontend') }}/css/plugins/fontawesome.min.css" />

<!-- All custom CSS Links -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/common.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/responsive.css" />
<link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css" />
<link rel="stylesheet" href="{{ asset('frontend') }}/css/dashbaord.css" />
<style>
    .invoice-container {
        max-width: 800px;
        margin: 50px auto 0;
        padding: 20px;
        border: 1px solid #eee;
        border-radius: 8px;
        background-color: white;
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .invoice-title {
        color: #333;
        font-size: 18px;
        font-style: normal;
        font-weight: 700;
        line-height: 28px;
        margin: 0;
    }

    .invoice-logo {
        width: 50px;
        height: 50px;
    }

    .invoice-info {
        margin: 20px 0;
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .invoice-info-box {
        flex: 1;
        border: 1px solid #eee;
        padding: 10px;
        border-radius: 8px;
    }

    .due-date {
        text-align: right;
    }

    .info-text {
        margin: 5px 0;
        color: #4D4D4D;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: 24px;
    }

    .table-container {
        overflow-x: auto;
        margin-top: 20px;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .table-header,
    .table-cell {
        padding: 10px;
        text-align: left;
        border: 1px solid #eee;
        font-size: 14px;
    }

    .table-header {
        font-weight: normal;
        text-align: center;
        color: #333;
        font-size: 14px;
        font-style: normal;
        font-weight: 700;
        line-height: 20px;
    }

    .totals {
        display: flex;
        justify-content: flex-end;
    }

    .totals-table {
        width: 300px;
        border-collapse: collapse;
    }

    .totals-header,
    .totals-cell {
        padding: 10px;
        text-align: left;
        font-size: 14px;
    }

    .totals-header {
        font-weight: normal;
    }

    .totals-cell-amount {
        font-weight: bold;
        text-align: right;
    }

    .totals-row-total .totals-cell {
        border-top: 1px solid #333;
    }

    .date-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }
</style>
@endpush
@section('content')
<div class="invoice-container">
    @php
        $subtotal = 0; // Initialize subtotal
        $firstOrder = $orders->first(); 
    @endphp

    <!-- Header -->

    <!-- Common Fields (Start Date and End Date) -->
    <div class="card d-flex align-content-between">
        <div class="align-content-between" >
            <p class=""><strong class="text-success">Start Date</strong></p>
            <p class="">
                {{ \Carbon\Carbon::parse($firstOrder->start_date)->format('j F, y') ?? '' }}
            </p>

            <p class=""><strong class="text-danger">End Date</strong></p>
            <p class="">
                {{ \Carbon\Carbon::parse($firstOrder->end_date)->format('j F, y') ?? '' }}
            </p>
        </div>
    </div>

    <!-- Campaign Details and Image for each order -->
    @foreach($orders as $order)
    <div class="invoice-header">
        <div>
            <h1 class="invoice-title">Campaign Details</h1>
        </div>
        <div class="logo" style="width: 20%; height: 20%;">
            <!-- Use $order->image instead of $firstOrder->image -->
            <img src="{{ asset($order->image) }}" style="width: 50%; height: 20%;"  alt="logo" />
        </div>
    </div>
    <div class="invoice-info">
        <div class="invoice-info-box">
            <p class="info-text"><strong>Campaign Information</strong></p>
            <p class="info-text"><strong>Campaign Name:</strong> {{ $order->name ?? '' }}</p>
            <p class="info-text"><strong>Category Name:</strong> {{ $order->category_name ?? '' }}</p>
            <p class="info-text"><strong>Description:</strong> {{ $order->description ?? '' }}</p>
        </div>
        <div class="invoice-info-box" style="flex-basis: 100%">
            <p class="info-text"><strong>Address</strong></p>
            <p class="info-text">
                {{ $order->location }}
            </p>
        </div>
    </div>
    @endforeach

    <!-- Table for all orders -->
    <div class="table-container">
        <table class="invoice-table">
            <thead>
                <tr>
                    <th class="table-header">Order Id</th>
                    <th class="table-header">Location</th>
                    <th class="table-header">Number of Days</th>
                    <th class="table-header">Price per day</th>
                    <th class="table-header">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="table-cell">{{ $order->uuid ?? '' }}</td>
                    <td class="table-cell">{{ $order->location ?? '' }}</td>
                    @php
                        $startDate = \Carbon\Carbon::parse($order->start_date);
                        $endDate = \Carbon\Carbon::parse($order->end_date);
                        $totalDays = $startDate->diffInDays($endDate);

                        $pricePerDay = $order->price_per_day;
                        $totalPrice = $pricePerDay * $totalDays;

                        $subtotal += $totalPrice; // Add to subtotal
                    @endphp
                    <td class="table-cell">{{ $totalDays > 0 ? $totalDays : 1 }}</td>
                    <td class="table-cell">{{ $order->price_per_day }} <img src="{{ asset('currency/realcurrency.png') }}" alt="" style="width: 15px; height: 15px;"></td>
                    <td class="table-cell">{{ $totalPrice }} <img src="{{ asset('currency/realcurrency.png') }}" alt="" style="width: 15px; height: 15px;"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Totals -->
    <div class="totals">
        <table class="totals-table">
            <tr>
                <th class="totals-header">Subtotal</th>
                <td class="totals-cell totals-cell-amount">{{ $subtotal }} <img src="{{ asset('currency/realcurrency.png') }}" alt="" style="width: 15px; height: 15px;"></td>
            </tr>
            <tr>
                <th class="totals-header">Discount</th>
                <td class="totals-cell totals-cell-amount">0</td>
            </tr>
            <tr>
                <th class="totals-header">Tax</th>
                <td class="totals-cell totals-cell-amount">0</td>
            </tr>
            <tr class="totals-row-total">
                <th class="totals-header">Total</th>
                <td class="totals-cell totals-cell-amount">{{ $subtotal }} <img src="{{ asset('currency/realcurrency.png') }}" alt="" style="width: 15px; height: 15px;"></td>
            </tr>
        </table>
    </div>
</div>
@endsection