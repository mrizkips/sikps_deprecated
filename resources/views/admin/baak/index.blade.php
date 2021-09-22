@extends('layouts.base')

@section('title', 'Daftar Petugas - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Petugas</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-notes">
                </i>&nbsp;Petugas BAAK</strong>
            </h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <strong class="text-primary">Daftar Petugas</strong>
                            <a href="{{ route('admin.baak.create') }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Petugas
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>NIP</td>
                                            <td>Nama</td>
                                            <td>Email</td>
                                            <td>No. HP</td>
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
            ajax: "{{ route('admin.baak.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nip', name: 'nip'},
                {data: 'user.nama', name: 'user.nama'},
                {data: 'user.email', name: 'user.email'},
                {data: 'no_hp', name: 'no_hp'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', 'searchable': false, orderable: false}
            ],
            order: ['5', 'desc']
        });
    });
</script>
@endsection
