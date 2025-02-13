<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Your Email Address</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            max-width: 600px;
            margin: 50px auto;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 120px;
        }

        h1 {
            text-align: center;
            font-size: 26px;
            margin-bottom: 25px;
            color: #333;
        }

        p {
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .otp-code {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #d9534f;
        }

        .btn {
            display: block;
            width: 100%;
            background-color: #0275d8;
            color: #fff;
            padding: 14px 0;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #025aa5;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
            color: #777;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="{{ asset('default/logo.png') }}" alt="Logo">
    </div>
    <h1>Email Verification Required</h1>
    <p>Please verify your email address to ensure you are the owner of this account.</p>
    <p>Your OTP code is: <span class="otp-code">{{ $otp }}</span></p>
    <p>Enter this code on the verification page to complete the process.</p>
    <a href="{{ route('email.otp') }}" class="btn">Verify Now</a>
    <div class="footer">
        <p>Kind regards,</p>
        <p>{{ config('app.name') }}</p>
    </div>
</div>
</body>
</html>
