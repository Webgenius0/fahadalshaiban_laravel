@extends('client.app', ['title' => 'Home'])
@section('content')
<div class="main-content">
    <div class="campaign-header">
        <div>
            <h4 class="campaign-header-title">All Invoice</h4>
            <p class="campaign-subtitle">Find out all your invoice</p>
        </div>

        <div></div>
    </div>

    <div class="table-container">
        <div class="responsive-table-wrapper">
            <table class="signage-table invoice-table">
                <thead>
                    <tr>
                        <th>Invoice Title</th>
                        <th>Date</th>
                        <th>ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Get 70% OFF Discount from Shashh</td>
                        <td>May 19, 2025</td>
                        <td>#ADS001245</td>
                        <td>
                            <div class="table-action-btns-wrapper">
                                <button 
                                    onclick="window.location.href='{{ route('page.invoice') }}'"
                                    class="table-action-btn table-action-btn-download">
                                    Download
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Get 70% OFF Discount from Shashh</td>
                        <td>May 19, 2025</td>
                        <td>#ADS001245</td>
                        <td>
                            <div class="table-action-btns-wrapper">
                                <button
                                    onclick="window.location.href='{{ route('page.invoice') }}'"
                                    class="table-action-btn table-action-btn-download">
                                    Download
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Get 70% OFF Discount from Shashh</td>
                        <td>May 19, 2025</td>
                        <td>#ADS001245</td>
                        <td>
                            <div class="table-action-btns-wrapper">
                                <button
                                    onclick="window.location.href='{{ route('page.invoice') }}'"
                                    class="table-action-btn table-action-btn-download">
                                    Download
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection