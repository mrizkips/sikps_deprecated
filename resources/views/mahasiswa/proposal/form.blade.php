@extends('layouts.base')

@section('title', isset($proposal) ? 'Edit Proposal - '.config('app.name') : 'Tambah Proposal - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('mahasiswa.proposal.index') }}">Proposal</a></li>
    <li class="breadcrumb-item active">{{ isset($proposal) ? 'Edit' : 'Tambah' }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-task">
            </i>&nbsp;Form</strong>&nbsp;<small>{{ isset($proposal) ? 'Edit' : 'Tambah' }} Proposal</small>
        </h3>
        <small class="text-danger"><em>Isian bertanda (*) wajib diisi</em></small>
        <form class="form-horizontal" action="{{ isset($proposal) ? route('mahasiswa.proposal.update', $proposal->id) : route('mahasiswa.proposal.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @isset($proposal) @method('PUT') @endif
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Input Data Proposal</strong></div>
                        <div class="card-body">
                            @include('proposal.component.fields')
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('mahasiswa.proposal.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success float-right"><i class="cil-send"></i> Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
