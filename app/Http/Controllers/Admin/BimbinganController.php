<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bimbingan;
use Yajra\DataTables\Facades\DataTables;

class BimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bimbingan = Bimbingan::query()->with(['proposal', 'mahasiswa.user', 'jadwal', 'dosen.user'])->select('bimbingan.*');
            return DataTables::eloquent($bimbingan)
                ->addIndexColumn()
                ->editColumn('jadwal.tanggal', function(Bimbingan $bimbingan) {
                    return date_format_id($bimbingan->jadwal->tanggal).", ".date('H:i', strtotime($bimbingan->jadwal->mulai))." - ".date('H:i', strtotime($bimbingan->jadwal->selesai));
                })
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('admin.bimbingan.show', $row->id)]);
                    return $show;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.bimbingan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bimbingan $bimbingan
     * @return \Illuminate\Http\Response
     */
    public function show(Bimbingan $bimbingan)
    {
        return view('admin.bimbingan.show', compact('bimbingan'));
    }
}
