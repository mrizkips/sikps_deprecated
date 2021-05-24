@extends('layouts.base')

@section('title', isset($mahasiswa) ? 'Edit Mahasiswa - '.config('app.name') : 'Tambah Mahasiswa - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.mahasiswa.index') }}">Mahasiswa</a></li>
    <li class="breadcrumb-item active">{{ isset($mahasiswa) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-people">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($mahasiswa) ? 'Edit' : 'Tambah' }} Mahasiswa</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($mahasiswa) ? route('admin.mahasiswa.update', $mahasiswa->id) : route('admin.mahasiswa.store') }}" method="post">
            @csrf
            @isset($mahasiswa) @method('PUT') @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Mahasiswa</strong></div>
                        <div class="card-body">
                            @include('mahasiswa.component.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
