@extends('layouts.export')

@section('title', 'Data Pengajuan Proposal')

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
            @foreach ($data as $proposal)
                <tr>
                    <td>{{ $proposal->mahasiswa->nim }}</td>
                    <td>{{ $proposal->judul }}</td>
                    <td>{{ $proposal->mahasiswa->user->nama }}</td>
                    <td>{{ config('constant.jenis_proposal')[$proposal->jenis] }}</td>
                    <td>{{ $proposal->dosen->user->nama }}</td>
                    <td>{{ config('constant.status')[$proposal->status->tipe] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
