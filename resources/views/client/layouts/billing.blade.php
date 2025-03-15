@php

// Retrieve the latest order by id
$orderId = App\Models\Order::latest('id')->first()->id;

@endphp
@extends('client.app', ['title' => 'Billing'])
@section('content')
<div class="main-content">
    <form id="billingAddressForm" class="billing-sections-wrapper">
        
        <div class="billings-wrapper">
            <div class="billings-wrapper-header">
                <h2>Billing Details</h2>
            </div>

            <div class="billing-details-input-wrapper">
                <input type="hidden" name="order_id" value="{{ $orderId }}" />
                <div class="input-wrapper-large">
                    <label>Full Name<span>*</span></label>
                    <input type="text" name="name" id="name" placeholder="Adam Smith" required />
                </div>
                <div class="input-wrapper-large">
                    <label>Email<span>*</span></label>
                    <input type="email" name="email" id="email" placeholder="adam_smith@Email.com" required />
                </div>
                <div class="input-wrapper-large">
                    <label>Phone Number<span>*</span></label>
                    <input type="tel" name="phone" id="phone" placeholder="+898-2786223" required />
                </div>
                <div class="input-wrapper-large">
                    <label>City<span>*</span></label>
                    <input type="text" name="city" id="city" placeholder="Riyadh" required />
                </div>
                <div class="input-wrapper-large">
                    <label>State/Province<span>*</span></label>
                    <input type="text" name="state" id="state" placeholder="Riyadh" required />
                </div>
                <div class="input-wrapper-large">
                    <label>Country<span>*</span></label>
                    <input type="text" name="country" id="country" placeholder="Saudi Arabia" required />
                </div>
                <div class="input-wrapper-large">
                    <label>Postal Code<span>*</span></label>
                    <input type="text" name="postal_code" id="postal_code" placeholder="232874" required />
                </div>

                <div class="input-wrapper-large">
                   <button class="auth-submit-btn">Checkout</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $('#billingAddressForm').on('submit', function (e) {
        e.preventDefault(); 
        var formData = new FormData(this);

        $.ajax({
            url: '{{ route("storeBillingAddress") }}', 
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false, 
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function (response) {
                console.log('AJAX Success:', response); 
                window.location.href = response.redirect_url;  
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', xhr.responseJSON); 
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorMessage += errors[key][0] + '<br>';
                    }
                }
                alert('Error: ' + errorMessage); 
            }
        });
    });
});
</script>
@endpush
