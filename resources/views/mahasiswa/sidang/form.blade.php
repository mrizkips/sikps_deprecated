@extends('layouts.base')

@section('title', isset($sidang) ? 'Edit Sidang - '.config('app.name') : 'Tambah Sidang - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('mahasiswa.sidang.index') }}">Sidang</a></li>
    <li class="breadcrumb-item active">{{ isset($sidang) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-briefcase">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($sidang) ? 'Edit' : 'Tambah' }} Sidang</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($sidang) ? route('mahasiswa.sidang.update', $sidang->id) : route('mahasiswa.sidang.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @isset($sidang) @method('PUT') @endif
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Sidang</strong></div>
                        <div class="card-body">
                            @include('components.sidang.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('mahasiswa.sidang.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
