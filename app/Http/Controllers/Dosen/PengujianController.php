<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengujianRequest;
use App\Models\Dosen;
use App\Models\JadwalSidang;
use App\Models\Pendaftaran;
use App\Models\Pengujian;
use App\Models\Sidang;
use App\Services\PengujianService;
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
            ])->where('dosen_id', auth()->user()->dosen->id)->select('pengujian.*');
            return DataTables::eloquent($pengujian)
                ->addIndexColumn()
                ->editColumn('jadwal_sidang.tanggal', function(Pengujian $pengujian) {
                    return date_format_id($pengujian->jadwal_sidang->tanggal).", ".date('H:i', strtotime($pengujian->jadwal_sidang->mulai))." - ".date('H:i', strtotime($pengujian->jadwal_sidang->selesai));
                })
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('dosen.pengujian.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('dosen.pengujian.edit', $row->id)]);
                    return $show.$edit;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('dosen.pengujian.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengujian $pengujian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengujian $pengujian)
    {
        return view('dosen.pengujian.show', compact('pengujian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengujian $pengujian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengujian $pengujian)
    {
        $jadwal_sidang = JadwalSidang::orderBy('tanggal', 'desc')->get();
        $sidang = Sidang::whereHas('status', function(Builder $query) {
            $query->where('tipe', '1');
        })->get();
        $dosen = Dosen::all();
        $pendaftaran = Pendaftaran::where('jenis', '2')->orderBy('created_at', 'desc')->get();

        return view('dosen.pengujian.form', compact('sidang', 'jadwal_sidang', 'dosen', 'pendaftaran', 'pengujian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PengujianRequest  $request
     * @param  \App\Models\Pengujian                $pengujian
     * @param  \App\Services\PengujianService       $service
     * @return \Illuminate\Http\Response
     */
    public function update(PengujianRequest $request, Pengujian $pengujian, PengujianService $service)
    {
        if ($service->pembimbingEqualPenguji($request->dosen_id, $request->sidang_id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('pengujian.messages.errors.is_pembimbing'),
            ]);
        }

        $fields = $request->all();
        if ($service->update($fields, $pengujian)) {
            return redirect()->route('dosen.pengujian.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('pengujian.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('pengujian.messages.errors.create'),
        ]);
    }
}
