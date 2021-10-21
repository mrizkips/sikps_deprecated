@extends('layouts.base')

@section('title', $penilaian->form_penilaian->nama." - ".config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('mahasiswa.pengujian.show', $pengujian->id) }}">Pengujian</a></li>
    <li class="breadcrumb-item active">Penilaian {{ $penilaian->form_penilaian->nama }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-badge">
            </i>&nbsp;Data</strong>&nbsp;<small>Penilaian {{ $penilaian->form_penilaian->nama }}</small>
        </h3>
        <div class="row">
            <div class="col-md-10">
                <div class="card card-accent-primary">
                    <div class="card-header"><strong class="text-primary">Data Penilaian Sidang</strong></div>
                    <div class="card-body">
                        @include('components.penilaian.readonly')
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('mahasiswa.pengujian.show', $pengujian) }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
