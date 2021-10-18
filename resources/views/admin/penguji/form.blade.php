@extends('layouts.base')

@section('title', isset($penguji) ? 'Edit Penguji - '.config('app.name') : 'Tambah Penguji - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pengujian.show', $pengujian->id) }}">Pengujian</a></li>
    <li class="breadcrumb-item">Penguji</li>
    <li class="breadcrumb-item active">{{ isset($penguji) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-badge">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($penguji) ? 'Edit' : 'Tambah' }} Penguji</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($penguji) ? route('admin.penguji.update', ['penguji' => $penguji->id, 'pengujian' => $pengujian->id]) : route('admin.penguji.store', $pengujian->id) }}" method="post">
            @csrf
            @isset($penguji) @method('PUT') @endif
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Penguji</strong></div>
                        <div class="card-body">
                            @include('components.penguji.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.pengujian.show', $pengujian->id) }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
