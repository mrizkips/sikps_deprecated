@extends('layouts.base')

@section('title', isset($penilaian) ? 'Edit Penilaian - '.config('app.name') : 'Tambah Penilaian - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pengujian.show', $pengujian->id) }}">Pengujian</a></li>
    <li class="breadcrumb-item">Penilaian</li>
    <li class="breadcrumb-item active">{{ isset($penilaian) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-badge">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($penguji) ? 'Edit' : 'Tambah' }} Penilaian</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($penilaian) ? route('admin.penilaian.update', ['penilaian' => $penilaian, 'pengujian' => $pengujian]) : route('admin.penilaian.store', $pengujian) }}" method="post">
            @csrf
            @isset($penilaian) @method('PUT') @endif
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Penilaian</strong></div>
                        <div class="card-body">
                            @include('components.penilaian.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.pengujian.show', $pengujian) }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
