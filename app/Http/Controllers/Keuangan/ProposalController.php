<?php

namespace App\Http\Controllers\Keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Services\ProposalService;
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
            $proposal = Proposal::query()->with(['status', 'dosen.user', 'mahasiswa.user'])->select('proposal.*');
            return DataTables::eloquent($proposal)
                ->addIndexColumn()
                ->editColumn('jenis', 'components.proposal.jenis')
                ->addColumn('tipe', function($row) {
                    $badge = view('components.status', ['status' => $row->status->tipe]);
                    return $badge;
                })
                ->addColumn('action', function($row) {
                    $approve = view('components.proposal.approve', ['url' => route('keuangan.proposal.approval', $row->id), 'id' => $row->id]);
                    $disapprove = view('components.proposal.disapprove', ['url' => route('keuangan.proposal.approval', $row->id), 'id' => $row->id]);
                    $show = view('components.show', ['url' => route('keuangan.proposal.show', $row->id)]);
                    return $approve.$disapprove.$show;
                })
                ->rawColumns(['tipe', 'action'])
                ->make();
        }
        return view('keuangan.proposal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        return view('keuangan.proposal.show', compact('proposal'));
    }

    /**
     * Approve or disapprove proposal.
     *
     * @param   \Illuminate\Http\Request $request
     * @param   \App\Models\Proposal $proposal
     * @param   \App\Services\ProposalService $service
     * @return  \Illuminate\Http\Response
     */
    public function approval(Request $request, Proposal $proposal, ProposalService $service)
    {
        $fields = $request->all();

        if ($request->tipe == "1") {
            $success = trans('proposal.messages.success.approve');
            $error = trans('proposal.messages.errors.approve');
        } else if ($request->tipe = "2") {
            $success = trans('proposal.messages.success.disapprove');
            $error = trans('proposal.messages.errors.disapprove');
        }

        if ($service->approval($proposal, $fields)) {
            return redirect()->route('keuangan.proposal.index')->with('flash_messages', [
                'type' => 'success',
                'message' => $success,
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => $error,
        ]);
    }
}
