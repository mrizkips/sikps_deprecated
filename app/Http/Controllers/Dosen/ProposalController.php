<?php

namespace App\Http\Controllers\Dosen;

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
        $user = auth()->user();
        if ($request->ajax()) {
            $proposal = Proposal::query()->with(['status', 'dosen.user', 'mahasiswa.user'])->select('proposal.*')->where('dosen_id', $user->dosen->id);
            return DataTables::eloquent($proposal)
                ->addIndexColumn()
                ->editColumn('jenis', 'proposal.component.jenis')
                ->addColumn('tipe', function($row) {
                    $badge = view('proposal.component.status', ['status' => $row->status->tipe]);
                    return $badge;
                })
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('dosen.proposal.show', $row->id)]);
                    return $show;
                })
                ->rawColumns(['tipe', 'action'])
                ->make();
        }
        return view('dosen.proposal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        return view('dosen.proposal.show', compact('proposal'));
    }
}
