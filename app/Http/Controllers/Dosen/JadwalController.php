<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalRequest;
use App\Models\Jadwal;
use App\Services\JadwalService;
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
            $jadwal = Jadwal::query()->with(['dosen.user'])->select('jadwal.*')->where('dosen_id', auth()->user()->dosen->id);
            return DataTables::eloquent($jadwal)
                ->addIndexColumn()
                ->editColumn('tanggal', '{{ date_format_id($tanggal) }}')
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('dosen.jadwal.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('dosen.jadwal.edit', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('dosen.jadwal.destroy', $row->id)]);
                    return $show.$edit.$destroy;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('dosen.jadwal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dosen.jadwal.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\JadwalRequest  $request
     * @param  \App\Services\JadwalService $service
     * @return \Illuminate\Http\Response
     */
    public function store(JadwalRequest $request, JadwalService $service)
    {
        $fields = $request->all();
        $dosen = auth()->user()->dosen;
        if ($service->create($fields, $dosen)) {
            return redirect()->route('dosen.jadwal.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('jadwal.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('jadwal.messages.errors.create'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        return view('dosen.jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        return view('dosen.jadwal.form', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\JadwalRequest  $request
     * @param  \App\Models\Jadwal                $jadwal
     * @param  \App\Services\JadwalService       $service
     * @return \Illuminate\Http\Response
     */
    public function update(JadwalRequest $request, Jadwal $jadwal, JadwalService $service)
    {
        $fields = $request->all();
        if ($service->update($fields, $jadwal)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('jadwal.messages.success.update'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('jadwal.messages.errors.update'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Services\JadwalService $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, JadwalService $service)
    {
        if (!$jadwal = Jadwal::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('jadwal.messages.errors.not_found'),
            ]);
        }

        if($service->delete($jadwal)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('jadwal.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('jadwal.messages.errors.delete'),
        ]);
    }
}
