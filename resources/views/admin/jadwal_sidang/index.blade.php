@extends('layouts.base')

@section('title', 'Jadwal Sidang - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Jadwal Sidang</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-paperclip">
                </i>&nbsp;Jadwal Sidang</strong>
            </h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <strong class="text-primary">List Jadwal Sidang</strong>
                            <a href="{{ route("admin.jadwal_sidang.create") }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Jadwal Sidang
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Periode Pendaftaran</td>
                                            <td>Tanggal</td>
                                            <td>Mulai</td>
                                            <td>Selesai</td>
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
            ajax: "{{ route('admin.jadwal_sidang.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'pendaftaran.judul', name: 'pendaftaran.judul'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'mulai', name: 'mulai'},
                {data: 'selesai', name: 'selesai'},
                {data: 'catatan', name: 'catatan', searchable: false, orderable: false},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: ['5', 'desc']
        });
    });
</script>
@endsection
