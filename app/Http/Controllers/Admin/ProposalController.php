<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Proposal;
use App\Services\ProposalService;
use App\Traits\Uploadable;
use Yajra\DataTables\Facades\DataTables;

class ProposalController extends Controller
{
    use Uploadable;

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
                ->editColumn('jenis', 'proposal.component.jenis')
                ->addColumn('tipe', function($row) {
                    $badge = view('proposal.component.status', ['status' => $row->status->tipe]);
                    return $badge;
                })
                ->addColumn('action', function($row) {
                    $approve = view('proposal.component.approve', ['url' => route('admin.proposal.approval', $row->id), 'id' => $row->id]);
                    $disapprove = view('proposal.component.disapprove', ['url' => route('admin.proposal.approval', $row->id), 'id' => $row->id]);
                    $show = view('components.show', ['url' => route('admin.proposal.show', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('admin.proposal.destroy', $row->id)]);

                    if ($row->status->tipe == "1") {
                        $dosen = Dosen::all();
                        $assign = view('proposal.component.assign', ['url' => route('admin.proposal.assign', $row->id), 'id' => $row->id, 'dosen' => $dosen]);
                        return $approve.$disapprove.$assign.$show.$destroy;
                    }

                    return $approve.$disapprove.$show.$destroy;
                })
                ->rawColumns(['tipe', 'action'])
                ->make();
        }
        return view('admin.proposal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        $dosen = Dosen::all();
        return view('admin.proposal.show', compact('proposal', 'dosen'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ProposalService $service)
    {
        if (!$proposal = Proposal::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('proposal.messages.errors.not_found'),
            ]);
        }

        if ($service->delete($proposal)) {
            $this->deleteFile($proposal->dokumen);
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('proposal.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('proposal.messages.errors.delete'),
        ]);
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
        } else if ($request->tipe == "2") {
            $success = trans('proposal.messages.success.disapprove');
            $error = trans('proposal.messages.errors.disapprove');
        }

        if ($service->approval($proposal, $fields)) {
            return redirect()->route('admin.proposal.index')->with('flash_messages', [
                'type' => 'success',
                'message' => $success,
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => $error,
        ]);
    }

    /**
     * Assign a mentor.
     *
     * @param   \Illuminate\Http\Request        $request
     * @param   \App\Models\Proposal            $proposal
     * @param   \App\Services\ProposalService   $service
     * @return  \Illuminate\Http\Response
     */
    public function assign(Request $request, Proposal $proposal, ProposalService $service)
    {
        $fields = $request->all();

        if ($service->update($proposal, $fields)) {
            return redirect()->route('admin.proposal.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('proposal.messages.success.assign'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('proposal.messages.errors.assign'),
        ]);
    }
}
