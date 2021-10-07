@extends('layouts.base')

@section('title', 'Jadwal Bimbingan - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Jadwal Bimbingan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-calendar">
                </i>&nbsp;Jadwal Bimbingan</strong>
            </h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <strong class="text-primary">Daftar Jadwal Bimbingan</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Dosen Pembimbing</td>
                                            <td>Tanggal</td>
                                            <td>Jam Mulai</td>
                                            <td>Jam Selesai</td>
                                            <td>Pin</td>
                                            <td>Link</td>
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
            ajax: "{{ route('admin.jadwal.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'dosen.user.nama', name: 'dosen.user.nama'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'mulai', name: 'mulai', searchable: false, orderable:false},
                {data: 'selesai', name: 'selesai', searchable: false, orderable:false},
                {data: 'pin', name: 'pin', searchable: false, orderable:false},
                {data: 'link', name: 'link', searchable: false, orderable:false, render: function (data,type) {
                    if (data === null) {
                        return "-";
                    }

                    if (type === 'display') {
                        return '<a href="' + data + '" class="btn btn-primary btn-sm" target="_blank"><i class="cil-external-link"></i> Buka Link</a>';
                    }

                    return data;
                }},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: ['7', 'desc']
        });
    });
</script>
@endsection
