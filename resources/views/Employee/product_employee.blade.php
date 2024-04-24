@extends('layouts.employee')
@section('content')

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>
                            Product
                        </h2>
                        <br>
                        <form class="input-group" action="" method="GET">
                            <div class="form-outline" data-mdb-input-init>
                                <label class="form-label" for="form1">Search</label>
                                <input type="text" id="search" class="form-control" name="search"/>
                            </div>  
                        </form>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scoxpe="col">No</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Name Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</th>
                                        <td>
                                            @if ($value->photo)
                                                <img src="{{ url('/storage/public/cover/' . $value->photo) }}" alt="Product Photo"
                                                    style="max-width: 100px;">
                                            @endif
                                         </td>
                                        <td>{{ $value->name }}</td>
                                        <td>Rp. {{ number_format($value->price, 2, ',', '.') }}</td>
                                        <td>{{ $value->stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 

    // function format_rupiah($angka)
    // {
    //     $jadi = "Rp " . number_format($angka, 2, ',', '.');
    //     return $jadi;
    // }
    ?>
@endsection
