<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Yajra\DataTables\Facades\DataTables;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $proposal = Proposal::query();
            return DataTables::eloquent($proposal)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('admin.proposal.show', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('admin.proposal.destroy', $row->id)]);
                    return $edit.$destroy;

                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.proposal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
