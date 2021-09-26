<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Models\Jurusan;
use App\Models\Kbb;
use App\Models\Mahasiswa;
use App\Services\MahasiswaService;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $mahasiswa = Mahasiswa::query()->with(['user']);
            return DataTables::eloquent($mahasiswa)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('admin.mahasiswa.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('admin.mahasiswa.edit', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('admin.mahasiswa.destroy', $row->id)]);
                    return $show.$edit.$destroy;

                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.mahasiswa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Mahasiswa $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Mahasiswa $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $kbb = Kbb::all();
        $jurusan = Jurusan::all();
        return view('admin.mahasiswa.form', compact('mahasiswa', 'kbb', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MahasiswaRequest  $request
     * @param  Mahasiswa $mahasiswa
     * @param  MahasiswaService $service
     * @return \Illuminate\Http\Response
     */
    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa, MahasiswaService $service)
    {
        $fields = $request->all();
        if (isset($fields['password'])) {
            $request->validate([
                'password' => ['required', 'string', 'min:4', 'confirmed']
            ]);
        }

        if ($service->update($mahasiswa, $fields)) {
            return redirect()->route('admin.mahasiswa.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('mahasiswa.messages.success.update'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('mahasiswa.messages.errors.update'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  MahasiswaService $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, MahasiswaService $service)
    {
        if (!$mahasiswa = Mahasiswa::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('mahasiswa.messages.errors.not_found'),
            ]);
        }

        if($service->delete($mahasiswa)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('mahasiswa.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('mahasiswa.messages.errors.delete'),
        ]);
    }
}
