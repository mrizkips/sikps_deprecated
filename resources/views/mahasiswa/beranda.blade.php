@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-primary text-white">
                <div class="card-header">Selamat Datang</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Halo, {{ auth()->user()->nama }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
