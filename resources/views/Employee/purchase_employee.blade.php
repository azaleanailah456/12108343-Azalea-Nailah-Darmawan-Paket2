@extends('layouts.employee')
@section('content')

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>
                            Purchase
                        </h2>
                        <form class="input-group" action="" method="GET">
                            <div class="form-outline" data-mdb-input-init>
                                <label class="form-label" for="form1">Search</label>
                                <input type="search" id="form1" class="form-control" name="q"/>
                            </div>  
                        </form>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalCreate" style="margin-top: 10px">Create</a>
                        <form action="/export-excel" method="POST">
                            @csrf
                            <input type="text" value="{{json_encode($data)}}" name="data" hidden/>
                            <button type="submit" class="btn btn-success">Export</button>
                        </form>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Purchase Date</th>
                                    <th scope="col">Total Purchase</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td>{{ $value->customers->name }}</td>
                                        <td>{{ date('d F Y', strtotime($value->created_at)) }}</td>
                                        <td>{{ $value->total_purchase }}</td>
                                        <td>{{ $value->users->name }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <button class="btn btn-warning mx-4" data-bs-toggle="modal"
                                                    data-bs-target="#modalView-{{ $value->id }}">
                                                    detail
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal View-->
                    @foreach ($data as $key => $value)
                        <div class="modal fade" id="modalView-{{ $value->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Purchase Detail</h5>
                                        <ht>
                                            <br>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="margin-top: -20px;">

                                        <p>Customer Name : {{ $value->customers->name }}</p>
                                        <p>Customer Address : {{ $value->customers->address }}</p>
                                        <p>Customer Phone Number : {{ $value->customers->phone_number }}</p>

                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">QTY</th>
                                                    <th scope="col">Unit Price</th>
                                                    <th scope="col">Total Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($value->purchaseProduct as $valueProduct)
                                                    <tr>
                                                        <td>{{ $valueProduct->product->name }} </td>
                                                        <td>{{ $valueProduct->quantity }}</td>
                                                        <td>{{ $valueProduct->product->price }}</td>
                                                        <td>{{ $valueProduct->totalPrice }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div>
                                                <!-- Konten lain di sini -->
                                            </div>
                                            <div class="px-4 mt-3">
                                                <p><b>Total :</b> {{ $value->total_purchase }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column  align-items-center">
                                            <div class="text-center">
                                                <p>Created Date: {{ date('d F Y', strtotime($value->created_at)) }}</p>
                                            </div>
                                            <br>
                                            <div class="text-center">
                                                <p><b>Created By : </b> {{ $value->users->name }}</p>
                                            </div>
                                        </div>


                                        <div class="modal-footer" style="margin-bottom: -30px; margin-top:20px;">
                                            <a href="{{ route('generate-pdf', ['id' => $value->id]) }}"
                                                class="btn btn-secondary">Download PDF</a>
                                        </div>
                                        <div class="modal-footer" style="margin-bottom: -30px; margin-top:20px;">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- end modal view --}}
                    <!-- Modal Create-->
                    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Purchase</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="margin-top: -20px;">
                                    <form method="POST" action="{{ route('createPurchase') }}">
                                        @csrf

                                        <div class="row g-3 mt-3">
                                            <div class="col">
                                                <label for="Total Purchase"> Customer Name *</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row g-3 ">
                                            <div class="col">
                                                <label for="Total Purchase"> Customer Address *</label>
                                                <input type="text" name="address" id="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row g-3 ">
                                            <div class="col">
                                                <label for="Total Purchase"> Customer Phone Number *</label>
                                                <input type="text" name="phone_number" id="name"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <label for="products">Products:</label>
                                        <div id="products-container">
                                            <div class="product-item">
                                                <div class="row">
                                                    <div class="row g-3">
                                                        <div class="col">
                                                            <select name="products[0][product_id]" id="product"
                                                                class="form-control">
                                                                <option value="" selected>Select product</option>
                                                                @foreach ($product as $p)
                                                                    <option value="{{ $p->id }}"
                                                                        data-price="{{ $p->price }}">
                                                                        {{ $p->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <input type="text" name="products[0][price]"
                                                                class="form-control price-input" placeholder="Price"
                                                                id="price" required>

                                                        </div>
                                                        <div class="col">
                                                            <input type="number" name="products[0][quantity]"
                                                                class="form-control quantity-input" placeholder="Quantity"
                                                                id="quantity" required>

                                                        </div>

                                                        <div class="col">
                                                            <input type="text" name="products[0][totalPrice]"
                                                                id="totalPrice" class="form-control total-price-input"
                                                                placeholder="Total Price" readonly>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row g-3 mt-4">
                                            <div class="col">
                                                <label for="Total Purchase"> Total Purchase *</label>
                                                <input type="text" name="total_purchase" id="totalPurchase"
                                                    class="form-control" placeholder="Total Purchase" readonly>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="modal-footer" style="margin-bottom: -30px; margin-top:20px;">
                                            <button type="button" class="btn btn-primary mt-2" id="add-product">Add
                                                Product</button>

                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>



                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end modal create --}}


                </div>
            </div>
        </div>
    </div>
    <script>

        function updateTotalPurchase() {
            const totalPriceInputs = document.querySelectorAll('.total-price-input');
            let totalPurchase = 0;

            totalPriceInputs.forEach(function(input) {
                if (!isNaN(parseFloat(input.value))) {
                    totalPurchase += parseFloat(input.value);
                }
            });

            // Mengisi nilai totalPurchase pada input dengan id 'totalPurchase'
            document.getElementById('totalPurchase').value = totalPurchase;
        }


        document.getElementById('add-product').addEventListener('click', function() {
            const productsContainer = document.getElementById('products-container');
            const productCount = productsContainer.querySelectorAll('.product-item').length;
            const newProductItem = `
        <div class="product-item mt-2">
            <div class="row">
                <div class="row g-3">
                    <div class="col">
                        <select name="products[${productCount}][product_id]" class="form-control product-select">
                            <option value="" selected>Select product</option>
                            @foreach ($product as $p)
                                <option value="{{ $p->id }}" data-price="{{ $p->price }}">
                                    {{ $p->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="number" id="price" name="products[${productCount}][price]" class="form-control price-input" placeholder="Price" readonly>
                    </div>
                    <div class="col">
                        <input type="number" id="quantity" name="products[${productCount}][quantity]" class="form-control  quantity-input" placeholder="Quantity" required>
                    </div>
                    <div class="col">
                        <input type="text" id="totalPrice" name="products[${productCount}][totalPrice]" class="form-control total-price-input" placeholder="Total Price" readonly>
                    </div>
                </div>
            </div>
        </div>
    `;
            productsContainer.insertAdjacentHTML('beforeend', newProductItem);

            // Memanggil fungsi untuk mengupdate nilai harga pada setiap produk baru
            updatePrices();
            updateTotalPurchase();
        });
    </script>
    <script>
        // Mendengarkan perubahan pada select box produk
        document.getElementById('product').addEventListener('change', function() {
            // Mendapatkan nilai harga dari opsi yang dipilih
            var selectedProduct = this.options[this.selectedIndex];
            var price = selectedProduct.getAttribute('data-price');

            // Mengonversi harga menjadi format mata uang rupiah
            var formattedPrice = price;
            // Mengisi nilai input harga dengan harga produk yang dipilih dalam format rupiah
            document.getElementById('price').value = formattedPrice;
        });

        function updatePrices() {
            const productSelects = document.querySelectorAll('.product-select');
            productSelects.forEach(function(select) {
                select.addEventListener('change', function() {
                    const selectedProduct = this.options[this.selectedIndex];
                    const price = selectedProduct.getAttribute('data-price');
                    const formattedPrice = price;

                    // Memperbarui nilai harga pada baris produk yang dipilih
                    const parentRow = this.closest('.row');
                    const priceInput = parentRow.querySelector('.price-input');
                    const quantity = parentRow.querySelector('.quantity-input').value;
                    const formatTotalPrice = quantity * formattedPrice;
                    const totalPrice = parentRow.querySelector('.total-price-input');
                    totalPrice.value = formatTotalPrice;
                    priceInput.value = formattedPrice;
                    console.log('pemai', 12);

                    // Memanggil fungsi untuk mengupdate total harga setelah perubahan pada nilai harga
                    updateTotalPurchase();
                });
            });
        }


        //

        // Function to update total price of a row
        function updateRowTotal(row) {
            const price = parseFloat(row.querySelector('.price-input').value);
            const quantity = parseFloat(row.querySelector('.quantity-input').value);
            const totalPriceInput = row.querySelector('.total-price-input');


            if (!isNaN(price) && !isNaN(quantity)) {
                const totalPrice = price * quantity;
                totalPriceInput.value = totalPrice;
            } else {
                totalPriceInput.value = '';
            }
        }

        // Event listener for quantity and price inputs
        document.querySelectorAll('.quantity-input, .price-input').forEach(function(input) {
            input.addEventListener('input', function() {

                const row = this.closest('.product-item');
                updateRowTotal(row);
                updateTotalPurchase();

            });
        });




        function formatRupiah(angka) {
            var formatted = 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            return formatted;
        }
        // document.getElementById('quantity').addEventListener('input', updateTotalPrice);
        // document.getElementById('price').addEventListener('input', updateTotalPrice);

        // function updateTotalPrice() {
        //     const quantity = parseFloat(document.getElementById('quantity').value);
        //     const price = parseFloat(document.getElementById('price').value);
        //     const totalPriceInput = document.getElementById('totalPrice');

        //     if (!isNaN(quantity) && !isNaN(price)) {
        //         const totalPrice = quantity * price;
        //         totalPriceInput.value = totalPrice; // Menggunakan 2 desimal untuk totalPrice
        //     } else {
        //         totalPriceInput.value = ''; // Kosongkan totalPrice jika input quantity atau price tidak valid
        //     }
        // }
    </script>



@endsection
