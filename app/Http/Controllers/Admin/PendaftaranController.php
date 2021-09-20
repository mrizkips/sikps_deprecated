<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PendaftaranRequest;
use App\Models\Pendaftaran;
use Yajra\DataTables\Facades\DataTables;

class PendaftaranController extends Controller
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
            $proposal = Pendaftaran::query();
            return DataTables::eloquent($proposal)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('admin.proposal.edit', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('admin.proposal.destroy', $row->id)]);
                    return $edit.$destroy;

                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.proposal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.proposal.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PendaftaranRequest $request)
    {
        $fields = $request->all();
        if (Pendaftaran::create($fields)) {
            return redirect()->route('admin.proposal.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('proposal.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('proposal.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftaran $proposal)
    {
        return view('admin.proposal.form', compact('proposal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PendaftaranRequest $request
     * @param  \App\Models\Pendaftaran $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(PendaftaranRequest $request, Pendaftaran $proposal)
    {
        $fields = $request->all();

        if ($proposal->update($fields)) {
            return redirect()->route('admin.proposal.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('proposal.messages.success.update'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('proposal.messages.errors.update'),
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
        if (!$proposal = Pendaftaran::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('petugas.messages.errors.not_found'),
            ]);
        }

        if($proposal->delete()) {
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
