@extends('layouts.base')

@section('title', "{$baak->user->nama} - ".config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.baak.index') }}">Petugas</a></li>
    <li class="breadcrumb-item active">{{ $baak->user->nama }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-notes">
            </i>&nbsp;Data</strong>&nbsp;<small>{{ $baak->user->nama }}</small>
        </h3>
        <form>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Data Petugas</strong></div>
                        <div class="card-body">
                            @include('baak.component.readonly', ['baak', $baak])
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.baak.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
