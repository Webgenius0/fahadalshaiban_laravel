@extends('client.app', ['title' => 'Campaign Details'])

@push('style')
    <link rel="icon" type="image/png" href="{{ asset('frontend') }}/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/plugins/bootstrap.min.css" />
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
            $subtotal = 0;
            $firstOrder = $orders->first();
            $isBillingInfoDisplayed = false; // Flag to track if billing info has been displayed
        @endphp

        <div class="col-12 text-end">
            <form action="{{ route('invoices.download') }}" method="POST">
                @csrf
                <input type="hidden" name="html_content" id="htmlContent">
                <button type="submit" 
                        class="btn btn-success btn-lg"
                        onclick="captureHTML()">
                    <i class="fas fa-download me-2"></i>Download PDF
                </button>
            </form>
        </div>

        <div class="row">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div>
                    <h1 class="invoice-title">Invoice</h1>
                    <p>Invoice Number: <span id="invoice-number"></span></p>
                </div>

                <img src="{{ asset('frontend') }}/images/favicon.png" alt="logo" />
            </div>
        </div>

        @foreach($orders as $order)
            @if (!$isBillingInfoDisplayed)
                <div class="invoice-info">
                    <div class="invoice-info-box">
                        <p class="info-text"><strong>Billed to</strong></p>
                        <p class="info-text">{{ $order->name }}<br />{{ $order->email }}</p>
                    </div>
                    <div class="invoice-info-box due-date">
                        <p class="info-text"><strong>Due Date</strong></p>
                        <p class="info-text">{{ $order->end_date ? \Carbon\Carbon::parse($order->end_date)->format('j F, y') : 'N/A' }}</p>
                    </div>
                    <div class="invoice-info-box" style="flex-basis: 100%">
                        <p class="info-text"><strong>Address</strong></p>
                        <p class="info-text">
                            {{ $order->city . ', ' . $order->state . ', ' . $order->country }}
                        </p>
                    </div>
                </div>
                @php
                    $isBillingInfoDisplayed = true; // Set flag to true after displaying billing info
                @endphp
            @endif
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
            <table class="totals-table border">
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

@push('script')
    <script>
        // Generate a random invoice number
        function generateInvoiceNumber() {
            return '#' + Math.floor(Math.random() * 1000000);
        }

        // Display the generated invoice number in the span element
        document.getElementById('invoice-number').textContent = generateInvoiceNumber();

        // Capture the HTML for PDF download
        function captureHTML() {
            const content = document.querySelector('.invoice-container').outerHTML;
            document.getElementById('htmlContent').value = content;
        }
    </script>
@endpush
