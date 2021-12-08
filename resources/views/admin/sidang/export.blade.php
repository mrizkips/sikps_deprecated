@extends('layouts.export')

@section('title', 'Data Pengajuan Sidang')

@section('content')
    <style>
        table {
            font-size: 9pt;
        }

        table thead {
            font-weight: bold;
        }
    </style>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>NIM</td>
                <td>Judul</td>
                <td>Nama Mahasiswa</td>
                <td>Jenis</td>
                <td>Dosen Pembimbing</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $sidang)
                <tr>
                    <td>{{ $sidang->proposal->mahasiswa->nim }}</td>
                    <td>{{ $sidang->proposal->judul }}</td>
                    <td>{{ $sidang->proposal->mahasiswa->user->nama }}</td>
                    <td>{{ config('constant.jenis_sidang')[$sidang->jenis] }}</td>
                    <td>{{ $sidang->proposal->dosen->user->nama }}</td>
                    <td>{{ config('constant.status')[$sidang->status->tipe] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
