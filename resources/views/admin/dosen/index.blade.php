@extends('layouts.base')

@section('title', 'Daftar Dosen - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dosen</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-education">
                </i>&nbsp;Dosen</strong>
            </h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Dosen</strong>
                            <a href="{{ route('dosen.create') }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Dosen
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <td width="30px">#</td>
                                        <td>NIDN</td>
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
            ajax: "{{ route('dosen.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nidn', name: 'nidn'},
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
