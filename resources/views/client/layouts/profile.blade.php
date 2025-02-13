@extends('client.app', ['title' => 'Home'])
@section('content')
<div class="main-content">
    <div class="profile-form-container">
        <div class="profile-img-container">
            <img id="profilePreview" class="profile-img" src="{{ asset('frontend') }}/images/profile-img.png" alt="Profile">
            <label for="profileUpload" class="profile-upload-label"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 3.99985H6C4.89543 3.99985 4 4.89528 4 5.99985V17.9998C4 19.1044 4.89543 19.9998 6 19.9998H18C19.1046 19.9998 20 19.1044 20 17.9998V11.9998M18.4142 8.41405L19.5 7.32829C20.281 6.54724 20.281 5.28092 19.5 4.49988C18.7189 3.71883 17.4526 3.71883 16.6715 4.49989L15.5858 5.58563M18.4142 8.41405L12.3779 14.4504C12.0987 14.7296 11.7431 14.9199 11.356 14.9974L8.41422 15.5857L9.00257 12.644C9.08001 12.2568 9.27032 11.9012 9.54951 11.622L15.5858 5.58563M18.4142 8.41405L15.5858 5.58563" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg></label>
            <input type="file" id="profileUpload" class="profile-upload-input" accept="image/*">
        </div>
        <h2 class="profile-user-name">Tanvir Rahman</h2>
        <p class="profile-user-info">Your all information is safe and secure here</p>
        <form class="profile-form">
            <div class="profile-form-group">
                <label for="companyName" class="profile-form-label">Company Name*</label>
                <input type="text" id="companyName" class="profile-form-input" placeholder="Apple Inc">
            </div>
            <div class="profile-form-group">
                <label for="companyEmail" class="profile-form-label">Company Email*</label>
                <input type="email" id="companyEmail" class="profile-form-input" placeholder="admin_company@gmail.com">
            </div>
            <div class="profile-form-group">
                <label for="password" class="profile-form-label">Your Password*</label>
                <input type="password" id="password" class="profile-form-input" placeholder="********">
            </div>
            <div class="profile-form-group">
                <label for="confirmPassword" class="profile-form-label">Confirm Password*</label>
                <input type="password" id="confirmPassword" class="profile-form-input" placeholder="********">
            </div>
            <div class="profile-form-group">
                <label for="phoneNumber" class="profile-form-label">Phone Number*</label>
                <input type="tel" id="phoneNumber" class="profile-form-input" placeholder="+1 999 555 123">
            </div>
            <div class="profile-form-group">
                <label for="address" class="profile-form-label">Address*</label>
                <input type="text" id="address" class="profile-form-input" placeholder="134 Street, 5th Avenue">
            </div>
            <div class="profile-form-group">
                <label for="vatNumber" class="profile-form-label">VAT Number*</label>
                <input type="text" id="vatNumber" class="profile-form-input" placeholder="123-456-789-0123">
            </div>
            <button type="submit" class=" btn-common w-100">Save</button>
        </form>
    </div>
</div>
@endsection