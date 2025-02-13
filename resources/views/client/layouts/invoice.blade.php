<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Invoices | Shashh</title>
<!-- ==== All Css Links ==== -->
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
</style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div>
                <h1 class="invoice-title">Invoice</h1>
                <p class="info-text">Invoice Number <strong>#12949436</strong></p>
            </div>
            <div class="logo">
                <img src="{{ asset('frontend') }}/images/favicon.png" alt="logo" />
            </div>
        </div>

        <!-- Invoice Info -->
        <div class="invoice-info">
            <div class="invoice-info-box">
                <p class="info-text"><strong>Billed to</strong></p>
                <p class="info-text">ABC Enterprise<br />ABC@Enterprise.com</p>
            </div>
            <div class="invoice-info-box due-date">
                <p class="info-text"><strong>Due Date</strong></p>
                <p class="info-text">27 December 2025</p>
            </div>
            <div class="invoice-info-box" style="flex-basis: 100%">
                <p class="info-text"><strong>Address</strong></p>
                <p class="info-text">
                    ABC Enterprise, Street no 3, Road No 4, Dammam, Saudi Arabia
                </p>
            </div>
        </div>

        <!-- Table -->
        <div class="table-container">
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th class="table-header">Signage Id</th>
                        <th class="table-header">Location</th>
                        <th class="table-header">Number of Days</th>
                        <th class="table-header">Price per day</th>
                        <th class="table-header">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-cell">#223525</td>
                        <td class="table-cell">Dammam</td>
                        <td class="table-cell">5</td>
                        <td class="table-cell">SR 30</td>
                        <td class="table-cell">SR 180</td>
                    </tr>
                    <tr>
                        <td class="table-cell">#223525</td>
                        <td class="table-cell">Dammam</td>
                        <td class="table-cell">5</td>
                        <td class="table-cell">SR 30</td>
                        <td class="table-cell">SR 180</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Totals -->
        <div class="totals">
            <table class="totals-table">
                <tr>
                    <th class="totals-header">Subtotal</th>
                    <td class="totals-cell totals-cell-amount">SR 180</td>
                </tr>
                <tr>
                    <th class="totals-header">Discount</th>
                    <td class="totals-cell totals-cell-amount">SR 80</td>
                </tr>
                <tr>
                    <th class="totals-header">Tax</th>
                    <td class="totals-cell totals-cell-amount">SR 0</td>
                </tr>
                <tr class="totals-row-total">
                    <th class="totals-header">Total</th>
                    <td class="totals-cell totals-cell-amount">SR 260</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>