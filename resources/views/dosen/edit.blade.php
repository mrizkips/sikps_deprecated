@extends('layouts.base')

@section('title', 'Edit Profil - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Edit Profil</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-education">
            </i>&nbsp;Form</strong>&nbsp;<small>Edit Profil</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($dosen) ? $updateRoute : route('admin.dosen.store') }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Dosen</strong></div>
                        <div class="card-body">
                            @include('dosen.component.fields', ['dosen' => $dosen])
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
