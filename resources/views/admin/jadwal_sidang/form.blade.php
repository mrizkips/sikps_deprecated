@extends('layouts.base')

@section('title', isset($jadwal_sidang) ? 'Edit Jadwal Sidang - '.config('app.name') : 'Tambah Jadwal Sidang - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.jadwal_sidang.index') }}">Jadwal Sidang</a></li>
    <li class="breadcrumb-item active">{{ isset($jadwal_sidang) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-notes">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($jadwal_sidang) ? 'Edit' : 'Tambah' }} Jadwal Sidang</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($jadwal_sidang) ? route('admin.jadwal_sidang.update', $jadwal_sidang->id) : route('admin.jadwal_sidang.store') }}" method="post">
            @csrf
            @isset($jadwal_sidang) @method('PUT') @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Jadwal Sidang</strong></div>
                        <div class="card-body">
                            @include('admin.jadwal_sidang.component.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.jadwal_sidang.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
