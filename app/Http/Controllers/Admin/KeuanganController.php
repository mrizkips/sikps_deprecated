<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PetugasRequest;
use App\Models\Keuangan;
use App\Models\Role;
use App\Services\PetugasService;
use Yajra\DataTables\Facades\DataTables;

class KeuanganController extends Controller
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
            $keuangan = Keuangan::query()->with(['user']);
            return DataTables::eloquent($keuangan)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('admin.keuangan.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('admin.keuangan.edit', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('admin.keuangan.destroy', $row->id)]);
                    return $show.$edit.$destroy;

                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.keuangan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.keuangan.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PetugasRequest  $request
     * @param  \App\Services\PetugasService     $service
     * @return \Illuminate\Http\Response
     */
    public function store(PetugasRequest $request, PetugasService $service)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ]);

        $fields = $request->all();
        $role = Role::where('nama', 'keuangan')->first();
        $fields['role_id'] = $role->id;
        if ($service->create($fields)) {
            return redirect()->route('admin.keuangan.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('petugas.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('petugas.messages.errors.create'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function show(Keuangan $keuangan)
    {
        return view('admin.keuangan.show', compact('keuangan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Keuangan $keuangan)
    {
        return view('admin.keuangan.form', compact('keuangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PetugasRequest  $request
     * @param  Keuangan $keuangan
     * @param  PetugasService $service
     * @return \Illuminate\Http\Response
     */
    public function update(PetugasRequest $request, Keuangan $keuangan, PetugasService $service)
    {
        $fields = $request->all();
        if (isset($fields['password'])) {
            $request->validate([
                'password' => ['required', 'string', 'min:4', 'confirmed']
            ]);
        }

        if ($service->update($keuangan->user_id, $fields)) {
            return redirect()->route('admin.keuangan.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('petugas.messages.success.update'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('petugas.messages.errors.update'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  PetugasService $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PetugasService $service)
    {
        if (!$keuangan = Keuangan::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('dosen.messages.errors.not_found'),
            ]);
        }

        if($service->delete($keuangan->user_id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('dosen.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('dosen.messages.errors.delete'),
        ]);
    }
}
