<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PetugasRequest;
use App\Models\Baak;
use App\Models\Role;
use App\Services\PetugasService;
use Yajra\DataTables\Facades\DataTables;

class BaakController extends Controller
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
            $baak = Baak::query()->with(['user']);
            return DataTables::eloquent($baak)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('admin.baak.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('admin.baak.edit', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('admin.baak.destroy', $row->id)]);
                    return $show.$edit.$destroy;

                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.baak.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.baak.form');
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
        $role = Role::where('nama', 'baak')->first();
        $fields['role_id'] = $role->id;
        if ($service->create($fields)) {
            return redirect()->route('admin.baak.index')->with('flash_messages', [
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
     * @param  Baak  $baak
     * @return \Illuminate\Http\Response
     */
    public function show(Baak $baak)
    {
        return view('admin.baak.show', compact('baak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Baak  $baak
     * @return \Illuminate\Http\Response
     */
    public function edit(Baak $baak)
    {
        return view('admin.baak.form', compact('baak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PetugasRequest  $request
     * @param  Baak $baak
     * @param  PetugasService $service
     * @return \Illuminate\Http\Response
     */
    public function update(PetugasRequest $request, Baak $baak, PetugasService $service)
    {
        $fields = $request->all();
        if (isset($fields['password'])) {
            $request->validate([
                'password' => ['required', 'string', 'min:4', 'confirmed']
            ]);
        }

        if ($service->update($baak->user_id, $fields)) {
            return redirect()->route('admin.baak.index')->with('flash_messages', [
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
        if (!$baak = Baak::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('petugas.messages.errors.not_found'),
            ]);
        }

        if($service->delete($baak->user_id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('petugas.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('petugas.messages.errors.delete'),
        ]);
    }
}
