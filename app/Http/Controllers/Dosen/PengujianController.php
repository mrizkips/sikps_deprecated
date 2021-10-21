<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengujian;
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
                'pendaftaran',
                'sidang.proposal.dosen.user',
                'sidang.proposal.mahasiswa.user',
                'penguji.dosen.user',
            ])->whereHas('penguji', function (Builder $query) {
                $query->where('dosen_id', '=', auth()->user()->dosen->id);
            })->orWhereHas('sidang', function (Builder $query) {
                $query->whereHas('proposal', function (Builder $query) {
                    $query->where('dosen_id', auth()->user()->dosen->id);
                });
            })
            ->select('pengujian.*');
            return DataTables::eloquent($pengujian)
                ->addIndexColumn()
                ->editColumn('tanggal', function(Pengujian $pengujian) {
                    return date_format_id($pengujian->tanggal).", ".date('H:i', strtotime($pengujian->mulai))." - ".date('H:i', strtotime($pengujian->selesai));
                })->addColumn('dosen_penguji', function(Pengujian $pengujian) {
                    $penguji = $pengujian->penguji;
                    $nama = '';
                    foreach ($penguji as $value) {
                        $nama .= $value->dosen->user->nama;
                        if ($penguji->last() != $value) {
                            $nama .= ", ";
                        }
                    }
                    return $nama;
                })
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('dosen.pengujian.show', $row->id)]);
                    return $show;
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
     * @param  \App\Services\PengujianService $service
     * @return \Illuminate\Http\Response
     */
    public function show(Pengujian $pengujian, PengujianService $service)
    {
        $form_penilaian = $service->checkFormPenilaian(auth()->user(), $pengujian);
        return view('dosen.pengujian.show', compact('pengujian', 'form_penilaian'));
    }
}
