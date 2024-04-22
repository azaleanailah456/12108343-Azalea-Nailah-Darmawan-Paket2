@extends('layouts.employee')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2>
                        Selamat datang, <b>{{ Auth::user()->name }}</b>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection