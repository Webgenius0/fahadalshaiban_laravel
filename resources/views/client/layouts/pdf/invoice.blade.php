<!DOCTYPE html>
<html>
<head>
    <style>
        /* PDF-specific styles */
        body {
            font-family: 'DejaVu Sans', sans-serif;
            -webkit-print-color-adjust: exact;
            margin: 0;
            padding: 20px;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
           
            border-radius: 8px;
            padding: 20px;
            background: white;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .invoice-info {
            margin: 20px 0;
            display: table;
            width: 100%;
        }
        .invoice-info-box {
            display: table-cell;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .currency-img {
            width: 15px;
            height: 15px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Add your invoice content here -->
        @include('client.layouts.pdf.invoice-content')
    </div>
</body>
</html>