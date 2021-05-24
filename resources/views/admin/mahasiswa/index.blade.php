@extends('layouts.base')

@section('title', 'Daftar Mahasiswa - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Mahasiswa</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-people">
                </i>&nbsp;Mahasiswa</strong>
            </h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <strong class="text-primary">Daftar Mahasiswa</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" width="100%" id="dataTable">
                                <thead>
                                    <tr>
                                        <td width="30px">#</td>
                                        <td>NIM</td>
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
            ajax: "{{ route('admin.mahasiswa.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nim', name: 'nim'},
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
