<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengujian;
use App\Models\Proposal;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Facades\DataTables;

class PengujianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pengujian = Pengujian::query()->with([
                'dosen.user',
                'jadwal_sidang',
                'sidang.proposal.dosen.user',
                'sidang.proposal.mahasiswa.user',
            ])->whereHas('sidang', function(Builder $query) {
                $query->whereHas('proposal', function(Builder $query) {
                    $query->where('mahasiswa_id', auth()->user()->mahasiswa->id);
                });
            })->select('pengujian.*');
            return DataTables::eloquent($pengujian)
                ->addIndexColumn()
                ->editColumn('jadwal_sidang.tanggal', function(Pengujian $pengujian) {
                    return date_format_id($pengujian->jadwal_sidang->tanggal).", ".date('H:i', strtotime($pengujian->jadwal_sidang->mulai))." - ".date('H:i', strtotime($pengujian->jadwal_sidang->selesai));
                })
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('mahasiswa.pengujian.show', $row->id)]);
                    return $show;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('mahasiswa.pengujian.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengujian $pengujian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengujian $pengujian)
    {
        return view('mahasiswa.pengujian.show', compact('pengujian'));
    }
}
