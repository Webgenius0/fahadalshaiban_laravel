@extends('owner.app', ['title' => 'Income Statement'])
@section('content')
<div class="main-content">
    <section>
        <div class="campaign-header">
            <div>
                <h4 class="campaign-header-title">Income Statement</h4>
                <p class="campaign-subtitle">Your all Income showing here</p>
            </div>
        </div>

        <div class="table-container">
            <div class="responsive-table-wrapper">
                <table class="signage-table">
                    <thead>
                        <tr>
                            <th>Signage Name</th>
                            <th>Signage ID</th>
                            <th>Signage Location</th>
                            <th>Signage Type</th>
                            <th>Price per day</th>
                            <th>Total Screen Time</th>
                            <th>Total Revenue</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Dammam, Ohh</td>
                            <td>#14156</td>
                            <td>Dammam City</td>
                            <td>Billboard</td>
                            <td>SR 5</td>
                            <td>50 Hours</td>
                            <td>$92831</td>
                            <td>
                                <div class="table-action-btns-wrapper">
                                    <button
                                        class="table-action-btn table-action-btn-download">
                                        Download
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Dammam, Ohh</td>
                            <td>#14156</td>
                            <td>Dammam City</td>
                            <td>Billboard</td>
                            <td>SR 5</td>
                            <td>50 Hours</td>
                            <td>$92831</td>
                            <td>
                                <div class="table-action-btns-wrapper">
                                    <button
                                        class="table-action-btn table-action-btn-download">
                                        Download
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Dammam, Ohh</td>
                            <td>#14156</td>
                            <td>Dammam City</td>
                            <td>Billboard</td>
                            <td>SR 5</td>
                            <td>50 Hours</td>
                            <td>$92831</td>
                            <td>
                                <div class="table-action-btns-wrapper">
                                    <button
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
    </section>
</div>
@endsection
