<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            position: relative;
            border: 1px solid #543535;
        }
    </style>
    <title>CETAK DATA PURCHASE</title>
</head>

<body>

    <div class="form-group">
        <p align="center"><b>Laporan Data Purchase</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
            <tr>
                <th>Customer Name</th>
                <th>Customer Address</th>
                <th>Customer Phone Number</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>
            @foreach ($data as $key => $value)
            <tr>
                <td>{{ $value->customers->name }}</td>
                <td>{{ $value->customers->address }}</td>
                <td>{{ $value->customers->phone_number }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->quantity }}</td> <!-- Assuming there's a quantity property -->
                <td>{{ $value->unit_price }}</td> <!-- Assuming there's a unit_price property -->
                <td>{{ $value->total_price }}</td>
            </tr>
        @endforeach
        </table>
    </div>

</body>

</html>
