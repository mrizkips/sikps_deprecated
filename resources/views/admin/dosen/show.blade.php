@extends('layouts.base')

@section('title', "{$dosen->user->nama} - ".config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dosen.index') }}">Dosen</a></li>
    <li class="breadcrumb-item active">{{ $dosen->user->nama }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-education">
            </i>&nbsp;Data</strong>&nbsp;<small>{{ $dosen->user->nama }}</small>
        </h3>
        <form>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Data Dosen</strong></div>
                        <div class="card-body">
                            @include('dosen.component.readonly', ['dosen', $dosen])
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.dosen.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
