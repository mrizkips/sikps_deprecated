@extends('layouts.base')

@section('title', 'Pendaftaran - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Pendaftaran</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-notes">
                </i>&nbsp;Pendaftaran</strong>
            </h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <strong class="text-primary">List Pendaftaran</strong>
                            <a href="{{ route('admin.pendaftaran.create') }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Pendaftaran
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Judul</td>
                                            <td>Jenis</td>
                                            <td>Tanggal Pembuka</td>
                                            <td>Tanggal Penutup</td>
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
            ajax: "{{ route('admin.pendaftaran.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'judul', name: 'judul'},
                {data: 'jenis', name: 'jenis'},
                {data: 'awal', name: 'awal'},
                {data: 'akhir', name: 'akhir'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', 'searchable': false, orderable: false}
            ],
            order: ['5', 'desc']
        });
    });
</script>
@endsection
