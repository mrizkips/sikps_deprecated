<?php

namespace App\Http\Controllers\Admin;

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
            ])->select('pengujian.*');
            return DataTables::eloquent($pengujian)
                ->addIndexColumn()
                ->editColumn('jadwal_sidang.tanggal', function(Pengujian $pengujian) {
                    return date_format_id($pengujian->jadwal_sidang->tanggal).", ".date('H:i', strtotime($pengujian->jadwal_sidang->mulai))." - ".date('H:i', strtotime($pengujian->jadwal_sidang->selesai));
                })
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('admin.pengujian.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('admin.pengujian.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('admin.pengujian.destroy', $row->id)]);
                    return $show.$edit.$delete;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.pengujian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            return $this->getFields($request->pendaftaran_id);
        }

        $jadwal_sidang = JadwalSidang::orderBy('tanggal', 'desc')->get();
        $sidang = Sidang::whereHas('status', function(Builder $query) {
            $query->where('tipe', '1');
        })->get();
        $dosen = Dosen::all();
        $pendaftaran = Pendaftaran::where('jenis', '2')->orderBy('created_at', 'desc')->get();

        return view('admin.pengujian.form', compact('sidang', 'jadwal_sidang', 'dosen', 'pendaftaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PengujianRequest  $request
     * @param  \App\Services\PengujianService       $service
     * @return \Illuminate\Http\Response
     */
    public function store(PengujianRequest $request, PengujianService $service)
    {
        if ($service->isExisted($request->jadwal_sidang_id, $request->sidang_id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('pengujian.messages.errors.is_existed'),
            ]);
        }

        if ($service->pembimbingEqualPenguji($request->dosen_id, $request->sidang_id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('pengujian.messages.errors.is_pembimbing'),
            ]);
        }

        $fields = $request->all();
        if ($service->create($fields)) {
            return redirect()->route('admin.pengujian.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('pengujian.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('pengujian.messages.errors.create'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengujian $pengujian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengujian $pengujian)
    {
        return view('admin.pengujian.show', compact('pengujian'));
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

        return view('admin.pengujian.form', compact('sidang', 'jadwal_sidang', 'dosen', 'pendaftaran', 'pengujian'));
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
            return redirect()->route('admin.pengujian.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('pengujian.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('pengujian.messages.errors.create'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Services\PengujianService $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PengujianService $service)
    {
        if (!$pengujian = Pengujian::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('pengujian.messages.errors.not_found'),
            ]);
        }

        if($service->delete($pengujian)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('pengujian.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('pengujian.messages.errors.delete'),
        ]);
    }

    /**
     * Get fields by pendaftaran_id.
     *
     * @param int $pendaftaran_id
     * @return mixed
     */
    protected function getFields($pendaftaran_id)
    {
        $html[0] = "<option>".trans('pengujian.placeholders.jadwal_sidang_id')."</option>";
        $html[1] = "<option>".trans('pengujian.placeholders.sidang_id')."</option>";

        $jadwal_sidang = JadwalSidang::orderBy('tanggal', 'desc')->where('pendaftaran_id', $pendaftaran_id)->get();
        $sidang = Sidang::where('pendaftaran_id', $pendaftaran_id)->whereHas('status', function(Builder $query) {
            $query->where('tipe', '1');
        })->get();

        if ($jadwal_sidang->isNotEmpty()) {
            foreach ($jadwal_sidang as $value) {
                $html[0] .= "<option value='{$value->id}'>".date_format_id($value->tanggal)." (".date('H:i', strtotime($value->mulai))." - ".date('H:i', strtotime($value->selesai)).")</option>";
            }
        }

        if ($sidang->isNotEmpty()) {
            foreach ($sidang as $value) {
                $html[1] .= "<option value='{$value->id}'>{$value->proposal->judul} - {$value->proposal->mahasiswa->user->nama}</option>";
            }
        }

        return $html;
    }
}
