@extends('layouts._main')
@section('content')

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>
                            Product
                            <hr>
                        <a href="" class="btn btn-primary mb-4" data-bs-toggle="modal"
                            data-bs-target="#modalCreate">Create</a>
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
                                    <th scope="col">Photo</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
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
                                        <td>{{ $value->stock }}</td>
                                        <td>{{ format_rupiah($value->price) }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <button class="btn btn-success mx-4" data-bs-toggle="modal"
                                                    data-bs-target="#modalStock-{{ $value->id }}">
                                                    <i class='bx bx-plus'></i>
                                                </button>
                                                <button class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit-{{ $value->id }}">
                                                    <i class='bx bxs-pencil'></i>
                                                </button>
                                                <form action="{{ route('deleteProduct', ['id' => $value->id]) }}"
                                                    class="px-4" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger"><i
                                                            class='bx bx-trash'></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit-->
                                    <div class="modal fade" id="modalEdit-{{ $value->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="margin-top: -20px;">
                                                    <form action="{{ route('updateProduct', ['id' => $value->id]) }}" enctype="multipart/form-data"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <label class="col-md-12" style="font-size: 15px; margin-bottom: 5px">Nama Produk <span
                                                                            class="text-danger"></span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="name" aria-label="Name Product"
                                                                        value="{{ $value->name }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label class="col-md-12" style="font-size: 15px; margin-bottom: 5px">Stock Produk <span
                                                                            class="text-danger"></span></label>
                                                                    <input type="number" class="form-control"
                                                                        name="stock" value="{{ $value->stock }}"
                                                                        aria-label="stock" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <label class="col-md-12" style="font-size: 15px; margin-bottom: 5px">Price Produk <span
                                                                            class="text-danger"></span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="price" id=""
                                                                        value="{{ $value->price }}" aria-label="price">
                                                                </div>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <label class="col-md-12" style="font-size: 15px; margin-bottom: 5px">Photo Produk <span
                                                                            class="text-danger"></span></label>
                                                                    <input type="file" class="form-control"
                                                                        name="photo" id=""
                                                                        value="{{ $value->photo }}" aria-label="price">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer"
                                                            style="margin-bottom: -30px; margin-top:20px;">
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Stock-->
                                    <div class="modal fade" id="modalStock-{{ $value->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Stock</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="margin-top: -20px;">
                                                    <form action="{{ route('updateStock', ['id' => $value->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <label class="col-md-12" style="font-size: 15px; margin-bottom: 5px">Nama Produk <span
                                                                            class="text-danger"></span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="name" aria-label="Name Product"
                                                                        value="{{ $value->name }}" disabled>
                                                                </div>
                                                                <div class="col">
                                                                    <label class="col-md-12" style="font-size: 15px; margin-bottom: 5px">Stock Produk <span
                                                                            class="text-danger"></span></label>
                                                                    <input type="number" class="form-control"
                                                                        name="stock" aria-label="stock">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer"
                                                            style="margin-bottom: -30px; margin-top:20px;">
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal Create-->
                    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="margin-top: -20px;">
                                    <form action="{{ route('createProduct') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="row g-3">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Name Product" aria-label="Name Product">
                                                </div>
                                                <div class="col">
                                                    <input type="number" class="form-control" name="stock"
                                                        placeholder="stock" aria-label="stock">
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col">
                                                    <input type="text" class="form-control" id="rupiah2"
                                                        name="price" placeholder="price" aria-label="price">
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col">
                                                    <label class="col-md-12">Upload Foto</label>
                                                    <input type="file" class="form-control" name="photo"
                                                        accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer" style="margin-bottom: -30px; margin-top:20px;">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    function format_rupiah($angka)
    {
        $jadi = 'Rp ' . number_format($angka, 2, ',', '.');
        return $jadi;
    }
    ?>
@endsection
