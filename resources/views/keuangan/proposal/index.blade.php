@extends('layouts.base')

@section('title', 'Proposal - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Proposal</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-task">
                </i>&nbsp;Proposal</strong>
            </h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <strong class="text-primary">List Proposal</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Judul</td>
                                            <td>Jenis</td>
                                            <td>Nama Mahasiswa</td>
                                            <td>Status</td>
                                            <td>Dosen Pembimbing</td>
                                            <td>Tanggal Dibuat</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            language: {
                url: '{{ asset('js/dataTables.indonesian.json') }}'
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('keuangan.proposal.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'judul', name: 'judul'},
                {data: 'jenis', name: 'jenis'},
                {data: 'mahasiswa.user.nama', name: 'mahasiswa.user.nama'},
                {data: 'tipe', name: 'tipe', searchable: false, orderable:false},
                {data: 'dosen.user.nama', name: 'dosen.user.nama'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: ['6', 'desc']
        });
    });
</script>
@endsection
