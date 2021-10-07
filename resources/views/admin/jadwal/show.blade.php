@extends('layouts.base')

@section('title', "Jadwal Bimbingan - ".config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Jadwal Bimbingan</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-star">
            </i>&nbsp;Data</strong>&nbsp;<small>Jadwal Bimbingan</small>
        </h3>
        <div class="row">
            <div class="col-md-10">
                <div class="card card-accent-primary">
                    <div class="card-header"><strong class="text-primary">Data Jadwal Bimbingan</strong></div>
                    <div class="card-body">
                        @include('components.jadwal.readonly')
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
