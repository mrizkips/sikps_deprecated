@extends('layouts.base')

@section('title', 'Edit Profil - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item">Profil</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-people">
            </i>&nbsp;Form</strong>&nbsp;<small>Edit Profil</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ route('baak.profil.update', $baak->id) }}" method="post">
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
