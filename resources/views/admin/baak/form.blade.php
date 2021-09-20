@extends('layouts.base')

@section('title', isset($baak) ? 'Edit Petugas - '.config('app.name') : 'Tambah Petugas - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.baak.index') }}">Petugas</a></li>
    <li class="breadcrumb-item active">{{ isset($baak) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-notes">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($baak) ? 'Edit' : 'Tambah' }} Petugas</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($baak) ? route('admin.baak.update', $baak->id) : route('admin.baak.store') }}" method="post">
            @csrf
            @isset($baak) @method('PUT') @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Petugas</strong></div>
                        <div class="card-body">
                            @include('baak.component.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.baak.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
