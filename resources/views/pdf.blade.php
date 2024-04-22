<!DOCTYPE html>
<html>

<head>
    <title>Purchase Detail</title>
    <style>
        /* CSS styling for PDF content */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            /* Membuat teks menjadi rata tengah */
        }

        /* Add your custom CSS styling here */
        ul {
            padding-left: 0;
            /* Menghapus padding kiri */
            list-style-type: none;
            /* Menghapus bullet points */
            text-align: center;
            /* Mengatur posisi teks dalam ul menjadi rata tengah */
        }

        li {
            display: inline-block;
            /* Menjadikan elemen <li> menjadi inline block */
            margin-bottom: 20px;
            /* Menambahkan jarak antara elemen daftar */
            text-align: left;
            /* Mengembalikan teks ke posisi semula */
            margin-right: 20px;
            /* Memberikan jarak antar elemen <li> */
        }
    </style>
</head>

<body>
    <h1>Purchase Detail</h1>
    <p><strong>Customer Name:</strong> {{ $purchase->customers->name }}</p>
    <p><strong>Customer Address:</strong> {{ $purchase->customers->address }}</p>
    <p><strong>Customer Phone Number:</strong> {{ $purchase->customers->phone_number }}</p>
    <hr>
    <h2>Products</h2>
    <ul>
        <?php $totalPrice = 0; ?>
        @foreach ($purchase->products as $product)
            <li>
                <strong>Product Name:</strong> {{ $product->name }} <br>
                <strong>Quantity:</strong> {{ $product->pivot->quantity }} <br>
                <strong>Unit Price:</strong> Rp {{ number_format($product->pivot->unit_price, 0, ',', '.') }} <br>
                <strong>Total Price:</strong> Rp {{ number_format($product->pivot->totalPrice, 0, ',', '.') }} <br>
            </li>
            <?php $totalPrice += $product->pivot->totalPrice; ?>
        @endforeach
    </ul>
    <hr>
    <h2>Total Purchase</h2>
    <p>Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
</body>

</html>
