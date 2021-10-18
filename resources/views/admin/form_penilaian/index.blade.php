@extends('layouts.base')

@section('title', 'Form Penilaian - '.config('app.name'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">Form Penilaian</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-settings">
                </i>&nbsp;Form Penilaian</strong>
            </h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <strong class="text-primary">Daftar Form Penilaian</strong>
                            <a href="{{ route("admin.form_penilaian.create") }}" class="btn btn-primary float-right">
                                <i class="cil-plus"></i> Tambah Form Penilaian
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Nama Form</td>
                                            <td>Jenis Form</td>
                                            <td>Penilai</td>
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
            ajax: "{{ route('admin.form_penilaian.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nama', name: 'nama'},
                {data: 'jenis', name: 'jenis'},
                {data: 'penilai', name: 'penilai'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ],
            order: ['4', 'desc']
        });
    });
</script>
@endsection
