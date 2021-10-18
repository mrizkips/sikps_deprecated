@extends('layouts.base')

@section('title', isset($form_penilaian) ? 'Edit Form Penilaian - '.config('app.name') : 'Tambah Form Penilaian - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.form_penilaian.index') }}">Form Penilaian</a></li>
    <li class="breadcrumb-item active">{{ isset($form_penilaian) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-settings">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($form_penilaian) ? 'Edit' : 'Tambah' }} Form Penilaian</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($form_penilaian) ? route('admin.form_penilaian.update', $form_penilaian->id) : route('admin.form_penilaian.store') }}" method="post">
            @csrf
            @isset($form_penilaian) @method('PUT') @endif
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Form Penilaian</strong></div>
                        <div class="card-body">
                            @include('components.form_penilaian.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.form_penilaian.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
