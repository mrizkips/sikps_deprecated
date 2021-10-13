<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalSidangRequest;
use App\Models\JadwalSidang;
use App\Models\Pendaftaran;
use Yajra\DataTables\Facades\DataTables;

class JadwalSidangController extends Controller
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
            $jadwal_sidang = JadwalSidang::query()->with(['pendaftaran']);
            return DataTables::eloquent($jadwal_sidang)
                ->addIndexColumn()
                ->editColumn('tanggal', '{{ date_format_id($tanggal) }}')
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('admin.jadwal_sidang.edit', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('admin.jadwal_sidang.destroy', $row->id)]);
                    return $edit.$destroy;

                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.jadwal_sidang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pendaftaran = Pendaftaran::where('jenis', '2')->get();
        return view('admin.jadwal_sidang.form', compact('pendaftaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\JadwalSidangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JadwalSidangRequest $request)
    {
        $fields = $request->all();
        if (JadwalSidang::create($fields)) {
            return redirect()->route('admin.jadwal_sidang.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('jadwal_sidang.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('jadwal_sidang.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JadwalSidang $jadwal_sidang
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalSidang $jadwal_sidang)
    {
        $pendaftaran = Pendaftaran::where('jenis', '2')->orderBy('created_at', 'desc')->get();
        return view('admin.jadwal_sidang.form', compact('pendaftaran', 'jadwal_sidang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\JadwalSidangRequest  $request
     * @param  \App\Models\JadwalSidang
     * @return \Illuminate\Http\Response
     */
    public function update(JadwalSidangRequest $request, JadwalSidang $jadwal_sidang)
    {
        $fields = $request->all();
        if ($jadwal_sidang->update($fields)) {
            return redirect()->route('admin.jadwal_sidang.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('jadwal_sidang.messages.success.update'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('jadwal_sidang.messages.errors.update'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$jadwal_sidang = JadwalSidang::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('jadwal_sidang.messages.errors.not_found'),
            ]);
        }

        if($jadwal_sidang->delete()) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('jadwal_sidang.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('jadwal_sidang.messages.errors.delete'),
        ]);
    }
}
