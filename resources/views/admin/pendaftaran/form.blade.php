@extends('layouts.base')

@section('title', isset($pendaftaran) ? 'Edit Pendaftaran - '.config('app.name') : 'Tambah Pendaftaran - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pendaftaran.index') }}">Pendaftaran</a></li>
    <li class="breadcrumb-item active">{{ isset($pendaftaran) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-notes">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($pendaftaran) ? 'Edit' : 'Tambah' }} Pendaftaran</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($pendaftaran) ? route('admin.pendaftaran.update', $pendaftaran->id) : route('admin.pendaftaran.store') }}" method="post">
            @csrf
            @isset($pendaftaran) @method('PUT') @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Pendaftaran</strong></div>
                        <div class="card-body">
                            @include('admin.pendaftaran.component.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
