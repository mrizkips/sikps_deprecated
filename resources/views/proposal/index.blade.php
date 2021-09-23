@extends('layouts.base')

@section('title', 'Proposal - '.config('app.name'))

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <h3 class="mb-4"><strong><i class="cil-task">
                </i>&nbsp;Proposal</strong>
            </h3>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card card-accent-primary">
                        <div class="card-header">
                            <strong class="text-primary">List Proposal</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTable">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Judul</td>
                                            <td>Jenis</td>
                                            <td>Nama Mahasiswa</td>
                                            <td>KBB</td>
                                            <td>Status</td>
                                            <td>Dosen Pembimbing</td>
                                            <td>Tanggal Dibuat</td>
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
            ajax: "{{ route('proposal.index') }}",
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'judul', name: 'judul'},
                {data: 'jenis', name: 'jenis'},
                {data: 'mahasiswa.user.nama', name: 'mahasiswa.user.nama', orderable: false},
                {data: 'kbb.nama', name: 'kbb.nama', orderable: false},
                {data: 'tipe', name: 'tipe', searchable: false, orderable:false},
                {data: 'dosen', name: 'dosen', searchable: false, orderable:false, render: function(data, type) {
                    if (data === null) {
                        return "-"
                    }
                    return data.user.nama
                }},
                {data: 'created_at', name: 'created_at'},
            ],
            order: ['6', 'desc']
        });
    });
</script>
@endsection
