<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bimbingan;
use App\Models\Jadwal;
use App\Models\Proposal;
use App\Services\BimbinganService;
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
            $bimbingan = Bimbingan::query()->with(['proposal', 'mahasiswa.user', 'jadwal', 'dosen.user'])->where('dosen_id', auth()->user()->dosen->id)->select('bimbingan.*');
            return DataTables::eloquent($bimbingan)
                ->addIndexColumn()
                ->editColumn('jadwal.tanggal', function(Bimbingan $bimbingan) {
                    return date_format_id($bimbingan->jadwal->tanggal).", ".date('H:i', strtotime($bimbingan->jadwal->mulai))." - ".date('H:i', strtotime($bimbingan->jadwal->selesai));
                })
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('dosen.bimbingan.show', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('dosen.bimbingan.destroy', $row->id)]);
                    return $show.$destroy;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('dosen.bimbingan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bimbingan $bimbingan
     * @return \Illuminate\Http\Response
     */
    public function show(Bimbingan $bimbingan)
    {
        return view('dosen.bimbingan.show', compact('bimbingan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Services\BimbinganService $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, BimbinganService $service)
    {
        if (!$bimbingan = Bimbingan::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('bimbingan.messages.errors.not_found'),
            ]);
        }

        if($service->delete($bimbingan)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('bimbingan.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('bimbingan.messages.errors.delete'),
        ]);
    }
}
