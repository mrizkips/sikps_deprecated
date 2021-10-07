<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Yajra\DataTables\Facades\DataTables;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $jadwal = Jadwal::query()->with(['dosen.user'])->select('jadwal.*');
            return DataTables::eloquent($jadwal)
                ->addIndexColumn()
                ->editColumn('tanggal', '{{ date_format_id($tanggal) }}')
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('admin.jadwal.show', $row->id)]);
                    return $show;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.jadwal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        return view('admin.jadwal.show', compact('jadwal'));
    }
}
