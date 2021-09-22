@extends('layouts.base')

@section('title', "{$proposal->judul} - ".config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">{{ $proposal->judul }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-task">
            </i>&nbsp;Data</strong>&nbsp;<small>{{ $proposal->judul }}</small>
        </h3>
        <form>
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Data Proposal</strong></div>
                        <div class="card-body">
                            @include('proposal.component.readonly', $proposal)
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('mahasiswa.proposal.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
