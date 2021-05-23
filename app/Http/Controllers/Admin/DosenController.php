<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
use App\Services\DosenService;
use Yajra\DataTables\Facades\DataTables;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $dosen = Dosen::query()->with(['user']);
            return DataTables::eloquent($dosen)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('dosen.edit', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('dosen.destroy', $row->id)]);
                    return $edit.$destroy;

                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.dosen.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dosen.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\DosenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DosenRequest $request, DosenService $service)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ]);

        $fields = $request->all();
        if ($service->create($fields)) {
            return redirect()->route('dosen.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('dosen.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('dosen.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        return view('admin.dosen.form', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\DosenRequest  $request
     * @param  Dosen $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(DosenRequest $request, Dosen $dosen, DosenService $service)
    {
        $fields = $request->all();
        if (isset($fields['password'])) {
            $request->validate([
                'password' => ['required', 'string', 'min:4', 'confirmed']
            ]);
        }

        if ($service->update($dosen, $fields)) {
            return redirect()->route('dosen.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('dosen.messages.success.update'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('dosen.messages.errors.update'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DosenService $service)
    {
        if (!$dosen = Dosen::find($id)) {
            return redirect()->back()->with('alert', [
                'type' => 'danger',
                'message' => trans('dosen.messages.errors.not_found'),
            ]);
        }

        if($service->delete($dosen)) {
            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => trans('dosen.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('alert', [
            'type' => 'danger',
            'message' => trans('dosen.messages.errors.delete'),
        ]);
    }
}
