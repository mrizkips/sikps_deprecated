@extends('layouts.base')

@section('title', isset($bimbingan) ? 'Edit Bimbingan - '.config('app.name') : 'Tambah Bimbingan - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('mahasiswa.bimbingan.index') }}">Bimbingan</a></li>
    <li class="breadcrumb-item active">{{ isset($bimbingan) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-star">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($bimbingan) ? 'Edit' : 'Tambah' }} Bimbingan</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($bimbingan) ? route('mahasiswa.bimbingan.update', $bimbingan->id) : route('mahasiswa.bimbingan.store') }}" method="post">
            @csrf
            @isset($bimbingan) @method('PUT') @endif
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Bimbingan</strong></div>
                        <div class="card-body">
                            @include('components.bimbingan.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('mahasiswa.bimbingan.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
