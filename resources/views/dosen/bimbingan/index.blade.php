@extends('layouts.base')

@section('title', 'Bimbingan - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Bimbingan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-star">
                </i>&nbsp;Bimbingan</strong>
            </h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <strong class="text-primary">Daftar Bimbingan</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Proposal</td>
                                            <td>Dosen Pembimbing</td>
                                            <td>Mahasiswa</td>
                                            <td>Jadwal</td>
                                            <td>Catatan</td>
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
            ajax: "{{ route('dosen.bimbingan.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'proposal.judul', name: 'proposal.judul'},
                {data: 'dosen.user.nama', name: 'dosen.user.nama'},
                {data: 'mahasiswa.user.nama', name: 'mahasiswa.user.nama'},
                {data: 'jadwal.tanggal', name: 'jadwal.tanggal'},
                {data: 'catatan', name: 'catatan', searchable: false, orderable:false},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', searchable: false, orderable:false},
            ],
            order: ['6', 'desc']
        });
    });
</script>
@endsection
