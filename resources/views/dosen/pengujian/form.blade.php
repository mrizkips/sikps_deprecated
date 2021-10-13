@extends('layouts.base')

@section('title', isset($pengujian) ? 'Edit Pengujian - '.config('app.name') : 'Tambah Pengujian - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('dosen.pengujian.index') }}">Pengujian</a></li>
    <li class="breadcrumb-item active">{{ isset($pengujian) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-badge">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($pengujian) ? 'Edit' : 'Tambah' }} Pengujian</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($pengujian) ? route('dosen.pengujian.update', $pengujian->id) : route('dosen.pengujian.store') }}" method="post">
            @csrf
            @isset($pengujian) @method('PUT') @endif
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Pengujian</strong></div>
                        <div class="card-body">
                            @include('components.pengujian.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('dosen.pengujian.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
