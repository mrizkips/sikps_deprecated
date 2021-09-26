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
        <div class="row">
            <div class="col-md-10">
                <div class="card card-accent-primary">
                    <div class="card-header"><strong class="text-primary">Data Proposal</strong></div>
                    <div class="card-body">
                        @include('proposal.component.readonly', $proposal)
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('baak.proposal.index') }}" class="btn btn-secondary"><i class="cil-arrow-thick-left"></i> Kembali</a>
                        <button type="button" class="btn btn-outline-danger float-right" title="Tolak" data-toggle="modal" data-target="#disapproveModal"><i class="cil-ban"></i></button>
                        <button type="button" class="btn btn-outline-success float-right mr-1" title="Setuju" data-toggle="modal" data-target="#approveModal"><i class="cil-check"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="disapproveModal" tabindex="-1" role="dialog" aria-labelledby="disapproveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('baak.proposal.approval', $proposal->id) }}" method="post" class="float-right mr-1" onsubmit="return confirm('Apakah Anda yakin akan melakukan aksi ini?');">
                <div class="modal-header">
                    <h5 class="modal-title" id="disapproveModalLabel">Menolak Proposal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <input type="hidden" value="2" name="tipe">
                    <textarea name="catatan" id="catatan" class="form-control" placeholder="Catatan.. (Tidak wajib diisi)"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('baak.proposal.approval', $proposal->id) }}" method="post" class="float-right mr-1" onsubmit="return confirm('Apakah Anda yakin akan melakukan aksi ini?');">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveModalLabel">Menyetujui Proposal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('POST')
                    <input type="hidden" value="1" name="tipe">
                    <textarea name="catatan" id="catatan" class="form-control" placeholder="Catatan.. (Tidak wajib diisi)"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Setuju</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
