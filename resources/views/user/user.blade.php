@extends('layouts._main')
@section('content')

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>
                            User
                        </h2>
                        <hr>
                        <form class="input-group" action="" method="GET">
                            <div class="form-outline" data-mdb-input-init>
                                <label class="form-label" for="form1">Search</label>
                                <input type="search" id="form1" class="form-control" name="q"/>
                            </div>  
                        </form>
                            <a href="" class="btn btn-primary mb-4" data-bs-toggle="modal"
                                data-bs-target="#modalCreate" style="margin-top: 10px">Create</a>
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
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $value)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->role }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start">
                                                <button class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit-{{ $value->id }}">
                                                    <i class='bx bxs-pencil'></i>
                                                </button>
                                                <form action="{{ route('deleteUser', ['id' => $value->id]) }}"
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
                                                    <form action="{{ route('updateUser', ['id' => $value->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <input type="text" class="form-control" name="name"
                                                                        placeholder="Name User" aria-label="Name User" value="{{ $value->name }}">
                                                                </div>
                                                                <div class="col">
                                                                    <select name="role" id="" value={{$value->role}} class="form-control">
                                                                        <option value="{{ $value->role}}" selected disabled>{{ $value->role }}</option>
                                                                        <option value="admin">Admin</option>
                                                                        <option value="employee">Employee</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <input type="text" class="form-control" name="email"
                                                                        placeholder="email" aria-label="email" value="{{ $value->email }}">
                                                                </div>
                                                            </div>
                                                            <div class="row g-3">
                                                                <div class="col">
                                                                    <input type="password" class="form-control" name="password"
                                                                        placeholder="password" aria-label="password">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="margin-top: -20px;">
                                    <form action="{{ route('createUser') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="row g-3">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Name User" aria-label="Name User">
                                                </div>
                                                <div class="col">
                                                    <select name="role" id="" class="form-control">
                                                        <option value="" selected disabled>Pilih Option Role</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="employee">Employee</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="email" aria-label="email">
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col">
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="password" aria-label="password">
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
@endsection
