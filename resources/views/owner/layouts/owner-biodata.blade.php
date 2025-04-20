<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile Update</title>

    <!-- Dropify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-form-container {
            background: #fff;
            padding: 30px;
            width: 100%;
            max-width: 40%;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }

        .profile-img-container {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
         
        }

        .profile-upload-label {
            position: absolute;
            bottom: 0;
            right: 40%;
            background-color: #007bff;
            border-radius: 50%;
            padding: 6px;
            cursor: pointer;
            color: #fff;
        }

        .profile-user-name {
            text-align: center;
            margin: 10px 0 5px;
        }

        .profile-user-info {
            text-align: center;
            
            margin-bottom: 20px;
        }

        .profile-form-group {
            margin-bottom: 15px;
        }

        .profile-form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .profile-form-input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .btn-common {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
        }

        .btn-common:hover {
            background-color: #0056b3;
        }

        #profileUpload {
            display: none;
        }
    </style>
</head>

<body>

    <div class="profile-form-container">
        <form method="POST" action="{{ route('owner.biodata.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Picture Preview -->
            <div class="profile-img-container">
                <img id="profilePreview" class="profile-img" src="{{ asset('default/logo.png') }}" alt="Profile">
                
                <input type="file" id="profileUpload" accept="image/*" onchange="previewImage(event)">
            </div>

           
            <h1 class="profile-user-info">Please Fill This Form to Get Started</h1>

            <div class="profile-form-group">
                <label for="name" class="profile-form-label">Company Name*</label>
                <input type="text" id="name" class="profile-form-input" name="name" placeholder="Apple Inc" required>
            </div>

            <!-- <div class="profile-form-group">
                <label for="email" class="profile-form-label">Company Email*</label>
                <input type="email" id="email" class="profile-form-input" name="email" placeholder="admin@example.com" required>
            </div> -->

            <div class="profile-form-group">
                <label for="phone" class="profile-form-label">Phone Number*</label>
                <input type="tel" id="phone" class="profile-form-input" name="phone" placeholder="+1 555 123456" required>
            </div>

            <div class="profile-form-group">
                <label for="address" class="profile-form-label">Address*</label>
                <input type="text" id="address" class="profile-form-input" name="address" placeholder="123 Main St" required>
            </div>

            <div class="profile-form-group">
                <label for="vat_no" class="profile-form-label">VAT Number*</label>
                <input type="text" id="vat_no" class="profile-form-input" name="vat_no" placeholder="123-456-789" required>
            </div>

            <!-- Dropify Avatar Upload -->
            <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="image">Featured Image</label>
                                <input class="form-control dropify" accept="image/*" type="file" name="avatar">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

            <button type="submit" class="btn-common">Save</button>
        </form>
    </div>

    <!-- jQuery (Dropify prefers versions <= 3.5.1 for full compatibility) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

        <script>
            $('.dropify').dropify();
        </script>
</body>

</html>
