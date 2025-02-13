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
                        <th>Signage Name</th>
                        <th>Signage ID</th>
                        <th>Signage Location</th>
                        <th>Signage Type</th>
                        <th>Price per day</th>
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
                <strong id="total">R</strong>
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

    // console.log(orderData.items);
    let storedFormData = JSON.parse(localStorage.getItem('formData'));
    let artWorkUrl = storedFormData ? storedFormData.artWork : 'No image uploaded';
    const  totdoList  = {
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
   

    $.ajax({
        url: '/checkout', 
        type: 'POST',  
        data:  totdoList ,

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
            const despatchFee = "{{ env('DESPATCH_FEE') }}";
            $("#dispatchFee").text("RS " + despatchFee + "%");
            let perSignageFee = response.price_per_day;
            totalPrice += perSignageFee;
            $("#subTotal").text("RS " + totalPrice);
            let TotalwithDespatchFee = totalPrice + ((despatchFee / 100) * totalPrice);
            $("#total").text("RS " + TotalwithDespatchFee);  

            // Add this item to the orderData object
            orderData.items.push({
                signage_id: response.signage_id,
                price_per_day: response.price_per_day,
                rotation_time: response.rotation_time,
                avg_daily_views: response.avg_daily_views,
                total: response.price_per_day * response.rotation_time
            });

            orderData.subtotal = totalPrice;
            orderData.dispatchFee = (despatchFee / 100) * totalPrice;
            orderData.total = TotalwithDespatchFee;

            let row = `
                <tr>
                    <td>${response.name}</td>
                    <td>#${response.signage_id}</td>
                    <td>${response.location}</td>
                    <td>${response.category_name}</td>
                    <td>SR ${response.price_per_day}</td>
                    <td>${response.rotation_time}</td>
                    <td>${response.avg_daily_views}</td>
                </tr>
            `;
            $('.signage-table tbody').append(row);
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