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
                            <a href="{{ route("admin.pengujian.create") }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Pengujian
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Jadwal</td>
                                            <td>Ruangan</td>
                                            <td>Mahasiswa</td>
                                            <td>Judul Laporan</td>
                                            <td>Dosen Pembimbing</td>
                                            <td>Penguji</td>
                                            <td>Periode Pendaftaran</td>
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
            ajax: "{{ route('admin.pengujian.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'ruangan', name: 'ruangan'},
                {data: 'sidang.proposal.mahasiswa.user.nama', name: 'sidang.proposal.mahasiswa.user.nama'},
                {data: 'sidang.proposal.judul', name: 'sidang.proposal.judul'},
                {data: 'sidang.proposal.dosen.user.nama', name: 'sidang.proposal.dosen.user.nama'},
                {data: 'dosen_penguji', name: 'dosen_penguji', orderable: false, searchable: false},
                {data: 'pendaftaran.judul', name: 'pendaftaran.judul'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: ['5', 'desc']
        });
    });
</script>
@endsection
