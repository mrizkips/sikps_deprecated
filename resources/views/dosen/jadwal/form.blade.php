@extends('layouts.base')

@section('title', isset($jadwal) ? 'Edit Jadwal Bimbingan - '.config('app.name') : 'Tambah Jadwal Bimbingan - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('dosen.jadwal.index') }}">Jadwal Bimbingan</a></li>
    <li class="breadcrumb-item active">{{ isset($jadwal) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-calendar">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($jadwal) ? 'Edit' : 'Tambah' }} Jadwal Bimbingan</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($jadwal) ? route('dosen.jadwal.update', $jadwal->id) : route('dosen.jadwal.store') }}" method="post">
            @csrf
            @isset($jadwal) @method('PUT') @endif
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Jadwal Bimbingan</strong></div>
                        <div class="card-body">
                            @include('components.jadwal.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('dosen.jadwal.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
