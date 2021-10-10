@extends('layouts.base')

@section('title', config('constant.jenis_sidang')[$sidang->jenis]." - ".config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">{{ config('constant.jenis_sidang')[$sidang->jenis] }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <h3 class="mb-4"><strong><i class="cil-briefcase">
            </i>&nbsp;Data</strong>&nbsp;<small>{{ config('constant.jenis_sidang')[$sidang->jenis] }}</small>
        </h3>
        <form>
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-accent-primary">
                        <div class="card-header"><strong class="text-primary">Data Sidang</strong></div>
                        <div class="card-body">
                            @include('components.sidang.readonly', $sidang)
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('mahasiswa.sidang.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
