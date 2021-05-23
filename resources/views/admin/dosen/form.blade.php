@extends('layouts.base')

@section('title', isset($dosen) ? 'Edit Dosen - '.config('app.name') : 'Tambah Dosen - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('dosen.index') }}">Dosen</a></li>
    <li class="breadcrumb-item active">{{ isset($dosen) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-education">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($dosen) ? 'Edit' : 'Tambah' }} Dosen</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($dosen) ? route('dosen.update', $dosen->id) : route('dosen.store') }}" method="post">
            @csrf
            @isset($dosen) @method('PUT') @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Dosen</strong></div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="nama" class="col-md-3 col-form-label">Nama*</label>
                                <div class="col-md">
                                    @include('components.input', [
                                        'type' => 'text',
                                        'name' => 'nama',
                                        'value' => isset($dosen) ? $dosen->user->nama : old('nama'),
                                        'required' => false,
                                        'autofocus' => true,
                                        'placeholder' => trans('dosen.placeholders.nama'),
                                    ])
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jen_kel" class="col-md-3 col-form-label">Jenis Kelamin*</label>
                                <div class="col-md">
                                    <select name="jen_kel" id="jen_kel" class="form-control @error('jen_kel') is-invalid @enderror">
                                        <option>{{ trans('dosen.placeholders.jen_kel') }}</option>
                                        @foreach (config('constant.jen_kel') as $item)
                                            <option value="{{ $item }}" {{ isset($dosen) ? ($dosen->jen_kel == $item ? 'selected' : '') : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('jen_kel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label">Email*</label>
                                <div class="col-md">
                                    @include('components.input', [
                                        'type' => 'email',
                                        'name' => 'email',
                                        'value' => isset($dosen) ? $dosen->user->email : old('email'),
                                        'required' => false,
                                        'autofocus' => false,
                                        'placeholder' => trans('dosen.placeholders.email'),
                                    ])
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nidn" class="col-md-3 col-form-label">NIDN*</label>
                                <div class="col-md">
                                    @include('components.input', [
                                        'type' => 'text',
                                        'name' => 'nidn',
                                        'value' => isset($dosen) ? $dosen->nidn : old('nidn'),
                                        'required' => false,
                                        'autofocus' => false,
                                        'placeholder' => trans('dosen.placeholders.nidn'),
                                    ])
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_hp" class="col-md-3 col-form-label">No. HP*</label>
                                <div class="col-md">
                                    @include('components.input', [
                                        'type' => 'number',
                                        'name' => 'no_hp',
                                        'value' => isset($dosen) ? $dosen->no_hp : old('no_hp'),
                                        'required' => false,
                                        'autofocus' => false,
                                        'placeholder' => trans('dosen.placeholders.no_hp'),
                                    ])
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label">Password*</label>
                                <div class="col-md">
                                    @include('components.input', [
                                        'type' => 'password',
                                        'name' => 'password',
                                        'value' => old('password'),
                                        'required' => false,
                                        'autofocus' => false,
                                        'placeholder' => trans('dosen.placeholders.password'),
                                    ])
                                    <small class="form-text text-muted">Password tidak wajib diisi saat edit data</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-3 col-form-label">Konfirmasi Password*</label>
                                <div class="col-md">
                                    @include('components.input', [
                                        'type' => 'password',
                                        'name' => 'password_confirmation',
                                        'value' => old('password_confirmation'),
                                        'required' => false,
                                        'autofocus' => false,
                                        'placeholder' => trans('dosen.placeholders.password'),
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('dosen.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
