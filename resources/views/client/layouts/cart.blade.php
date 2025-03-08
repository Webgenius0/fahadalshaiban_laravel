@extends('client.app', ['title' => 'Home'])
@section('content')
<div class="main-content">
    <div class="campaign-header">
        <div>
            <h4 class="campaign-header-title">Cart</h4>
            <p class="campaign-subtitle">All your selected signage</p>
        </div>
    </div>

    <div class="table-container">
        <div class="responsive-table-wrapper">
            <table class="signage-table">
                <thead>
                    <tr>
                        <!-- <th>Image</th> -->
                         <th>Image</th>
                        <th>Signage Name</th>
                        
                        <th>Signage Location</th>
                        <th>Signage Type</th>
                        
                        <th>Price per day</th>
                        <th>Total Day</th>
                        <th>Rotation Time</th>
                        <th>Total Views</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>

        <div class="total-box">
            <div class="total-row">
                <span>Sub total</span>
                <span id="subTotal"></span>
            </div>
            <div class="total-row">
                <span>Dispatch Fee</span>
                <span id="dispatchFee"></span>
            </div>
            <div class="total-row total">
                <strong >Total</strong>
                <strong id="total"></strong>
            </div>
        </div>
    <!-- page.billing -->
        <div class="d-flex justify-content-center w-100" id="checkoutButtonContainer">
            <a href="{{ route('checkout') }}" class="btn-common" id="checkoutButton">
                Proceed to checkout
            </a>
        </div>
    </div>
</div>
@endsection
@push('script')

<script>
// Initialize an empty orderData object
let orderData = {
    items: [],
    subtotal: 0,
    dispatchFee: 0,
    total: 0,
    ad_title: '',
    campaign_description: '',
    art_work:'',
    start_date: '',
    end_date: '',
    differenceDays:'',
};

// On your other route/page (when the page loads):
$(document).ready(function() {
    var selectedSignageIds = JSON.parse(localStorage.getItem('selectedSignageIds')) || [];
    console.log("Retrieved Signage IDs: ", selectedSignageIds);

    // Loop through the selectedSignageIds and fetch data
    selectedSignageIds.forEach(function(id) {
        $('#selectedIdsList').append('<li>Signage ID: ' + id + '</li>');
        fetchDataForSignage(id); 
    });
});


$('#checkoutButton').click(function(event) {
    event.preventDefault();

    // Retrieve form data from localStorage
    let storedFormData = JSON.parse(localStorage.getItem('formData'));
    let artWorkUrl = storedFormData ? storedFormData.artWork : 'No image uploaded';

    // Calculate the number of days between startDate and endDate
    const startDate = new Date(storedFormData.startDate);
    const endDate = new Date(storedFormData.endDate);
    const timeDifference = endDate - startDate; // Difference in milliseconds
    const daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24)); // Convert to days

    // Prepare the data to be sent
    const totdoList = {
        addTitle: storedFormData.name,
        description: storedFormData.campaign_description,
        startDate: storedFormData.startDate,
        endDate: storedFormData.endDate,
        artWork: artWorkUrl,
        items: orderData.items,
        subtotal: orderData.subtotal,
        dispatchFee: orderData.dispatchFee,
        total: orderData.total,
        _token: '{{ csrf_token() }}'
    };

    // Send AJAX request
    $.ajax({
        url: '/checkout',
        type: 'POST',
        data: totdoList,
        success: function(response) {
            window.location.href = "{{ route('page.billing') }}";
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", error);
        }
    });
});

let totalPrice = 0;
function fetchDataForSignage(id) {
    $.ajax({
        url: '/get-signage-location/' + id,
        type: 'GET',
        success: function(response) {
            // Retrieve startDate and endDate from localStorage
            const storedFormData = JSON.parse(localStorage.getItem('formData'));
            const startDate = new Date(storedFormData.startDate);
            const endDate = new Date(storedFormData.endDate);

            // Calculate the number of days
            const timeDifference = endDate - startDate; // Difference in milliseconds
            const daysDifference = Math.ceil(timeDifference / (1000 * 60 * 60 * 24)); // Convert to days

            // Calculate subtotal based on daysDifference and price_per_day
            const perSignageFee = response.price_per_day;
            const signageSubtotal = perSignageFee * daysDifference;
            totalPrice += signageSubtotal;

            // Update the UI with the new subtotal
            const despatchFee = "{{ env('DESPATCH_FEE') }}";
            $("#dispatchFee").text("RS " + despatchFee + "%");
            $("#subTotal").html(totalPrice + ' <img src="{{ asset('currency/realcurrency.png') }}" alt="" style="width: 15px; height: 15px;">');

            // Calculate total with dispatch fee
            const TotalwithDespatchFee = totalPrice + ((despatchFee / 100) * totalPrice);
            $("#total").html(TotalwithDespatchFee + ' <img src="{{ asset('currency/realcurrency.png') }}" alt="" style="width: 15px; height: 15px;">');

            // Add this item to the orderData object
            orderData.items.push({
                signage_id: response.signage_id,
                price_per_day: response.price_per_day,
                rotation_time: response.rotation_time,
                avg_daily_views: response.avg_daily_views,
                total: signageSubtotal // Update total for this item
            });

            // Update orderData totals
            orderData.subtotal = totalPrice;
            orderData.dispatchFee = (despatchFee / 100) * totalPrice;
            orderData.total = TotalwithDespatchFee;

            // Add a new row to the table
            let row = `
                <tr>
                    <td><img src="{{asset('${response.image}')}}" style="width: 50px; height: 50px; border-radius: 50%;" alt="Signage Image"></td>
                    <td>${response.name}</td>
                    <td>${response.location}</td>
                    <td>${response.category_name}</td>
                    <td>${response.price_per_day} <img src="{{ asset('currency/realcurrency.png') }}" alt="" style="width: 15px; height: 15px;"></td>
                    <td>${daysDifference}</td>
                    <td>${response.exposure_time} sec per a minuit</td>
                    <td>${response.avg_daily_views * 1000}</td>
                </tr>
            `;
            $('.signage-table tbody').append(row);

            // Update the image preview if available
            if (response.image) {
                $('#uploaded-image-preview').attr('src', response.image);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", error);
        }
    });
}




</script>
@endpush