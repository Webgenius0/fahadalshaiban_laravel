<!-- resources/views/income-statement.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Statement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tbody td {
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="row">

       
        <div class="d-flex justify-content-between align-items-center w-100">
            <div>
            <img src="{{ public_path('/frontend/images/favicon.png') ?? 'No Image' }}" alt="Logo" style="width: 80px; height: auto; float: right;">
           <h1>Income Statement</h1>
                
            </div>

            
        </div>
    </div>
    

    <p>Generated for user: {{ $user->name }}</p>

    <table>
        <thead>
            <tr>
                <th>Order Id</th>
                <th>Name</th>
                <th>ID</th>
                <th>Location</th>
                <th>Category</th>
                <th>Per Day Price</th>
                <th>Exposure Time</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $data->uuid }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->id }}</td>
                <td>{{ $data->location }}</td>
                <td>{{ $data->category_name }}</td>
                <td>{{ $data->per_day_price }} <img src="{{ public_path('currency/realcurrency.png') }}" class="currency-img" style="height: 10px; width: 10px;"></td>
                <td>{{ $data->exposure_time }} second per a minute</td>
                <td>{{ $data->total }} <img src="{{ public_path('currency/realcurrency.png') }}" class="currency-img" style="height: 10px; width: 10px;"></td>
            </tr>
        </tbody>
    </table>

</body>
</html>
