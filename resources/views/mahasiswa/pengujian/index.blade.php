@extends('layouts.base')

@section('title', 'Pengujian - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Pengujian</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-badge">
                </i>&nbsp;Pengujian</strong>
            </h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <strong class="text-primary">Daftar Pengujian</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Jadwal</td>
                                            <td>Mahasiswa</td>
                                            <td>Judul Laporan</td>
                                            <td>Dosen Pembimbing</td>
                                            <td>Dosen Penguji</td>
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
            ajax: "{{ route('mahasiswa.pengujian.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'jadwal_sidang.tanggal', name: 'jadwal_sidang.tanggal'},
                {data: 'sidang.proposal.mahasiswa.user.nama', name: 'sidang.proposal.mahasiswa.user.nama'},
                {data: 'sidang.proposal.judul', name: 'sidang.proposal.judul'},
                {data: 'sidang.proposal.dosen.user.nama', name: 'sidang.proposal.dosen.user.nama'},
                {data: 'dosen.user.nama', name: 'dosen.user.nama'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: ['6', 'desc']
        });
    });
</script>
@endsection
