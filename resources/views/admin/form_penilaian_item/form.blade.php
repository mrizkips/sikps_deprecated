@extends('layouts.base')

@section('title', isset($form_penilaian_item) ? 'Edit Form Penilaian Item - '.config('app.name') : 'Tambah Form Penilaian Item - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.form_penilaian.index') }}">Form Penilaian</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.form_penilaian_item.index', $form_penilaian->id) }}">{{ $form_penilaian->nama }}</a></li>
    <li class="breadcrumb-item active">{{ isset($form_penilaian_item) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-badge">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($form_penilaian_item) ? 'Edit' : 'Tambah' }} Form Penilaian Item</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($form_penilaian_item) ? route('admin.form_penilaian_item.update', ['form_penilaian' => $form_penilaian->id, 'form_penilaian_item' => $form_penilaian_item->id]) : route('admin.form_penilaian_item.store', $form_penilaian->id) }}" method="post">
            @csrf
            @isset($form_penilaian_item) @method('PUT') @endif
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Form Penilaian Item</strong></div>
                        <div class="card-body">
                            @include('components.form_penilaian_item.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.form_penilaian_item.index', $form_penilaian->id) }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
