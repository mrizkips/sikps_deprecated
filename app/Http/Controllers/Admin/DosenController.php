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
                    $show = view('components.show', ['url' => route('admin.dosen.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('admin.dosen.edit', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('admin.dosen.destroy', $row->id)]);
                    return $show.$edit.$destroy;

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
     * @param  DosenService $service
     * @return \Illuminate\Http\Response
     */
    public function store(DosenRequest $request, DosenService $service)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:4', 'confirmed']
        ]);

        $fields = $request->all();
        if ($service->create($fields)) {
            return redirect()->route('admin.dosen.index')->with('flash_messages', [
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
     * Display the specified resource.
     *
     * @param  Dosen $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        return view('admin.dosen.show', compact('dosen'));
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
     * @param  DosenService $service
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
            return redirect()->route('admin.dosen.index')->with('flash_messages', [
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
     * @param  DosenService $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DosenService $service)
    {
        if (!$dosen = Dosen::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('dosen.messages.errors.not_found'),
            ]);
        }

        if($service->delete($dosen)) {
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
