<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Proposal;
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
            $proposal = Proposal::select('dosen_id')->where('mahasiswa_id', auth()->user()->mahasiswa->id)->get();
            foreach ($proposal as $key => $value) {
                $dosen[$key] = $value->dosen_id;
            }

            $jadwal = Jadwal::query()->with(['dosen.user'])->select('jadwal.*')->whereIn('dosen_id', $dosen);
            return DataTables::eloquent($jadwal)
                ->addIndexColumn()
                ->editColumn('tanggal', '{{ date_format_id($tanggal) }}')
                ->make();
        }
        return view('mahasiswa.jadwal.index');
    }
}
