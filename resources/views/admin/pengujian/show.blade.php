@extends('layouts.base')

@section('title', "Pengujian Sidang - ".config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Pengujian Sidang</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-badge">
            </i>&nbsp;Data</strong>&nbsp;<small>Pengujian Sidang</small>
        </h3>
        <div class="row">
            <div class="col-md-10">
                <div class="card card-accent-primary">
                    <div class="card-header"><strong class="text-primary">Data Pengujian Sidang</strong></div>
                    <div class="card-body">
                        @include('components.pengujian.readonly')
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.pengujian.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
