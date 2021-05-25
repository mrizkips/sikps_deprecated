@extends('layouts.base')

@section('title', 'Edit Password - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Edit Password</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-lock-locked">
            </i>&nbsp;Form</strong>&nbsp;<small>Edit Password</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ route('admin.edit_password') }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Password</strong></div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label">Password*</label>
                                <div class="col-md">
                                    @include('components.input', [
                                        'type' => 'password',
                                        'name' => 'password',
                                        'value' => old('password'),
                                        'required' => false,
                                        'autofocus' => true,
                                        'placeholder' => "",
                                    ])
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
                                        'placeholder' => "",
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
