@extends('layouts.base')

@section('title', "Profil {$keuangan->user->nama} - ".config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">{{ $keuangan->user->nama }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-people">
            </i>&nbsp;Data</strong>&nbsp;<small>{{ $keuangan->user->nama }}</small>
        </h3>
        <form>
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Data Petugas Keuangan</strong></div>
                        <div class="card-body">
                            @include('keuangan.component.readonly', ['keuangan', $keuangan])
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
