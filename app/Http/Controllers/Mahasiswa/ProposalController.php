<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProposalRequest;
use App\Models\Kbb;
use App\Models\Pendaftaran;
use App\Models\Proposal;
use App\Services\ProposalService;
use App\Traits\Uploadable;
use Yajra\DataTables\Facades\DataTables;

class ProposalController extends Controller
{
    use Uploadable;

    /**
     * Upload file path variable.
     *
     * @var string
     */
    protected $file_path = 'proposal/';

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $proposal = Proposal::query()->with(['status', 'dosen.user', 'mahasiswa'])->select('proposal.*')->where('mahasiswa_id', auth()->user()->mahasiswa->id);
            return DataTables::eloquent($proposal)
                ->addIndexColumn()
                ->editColumn('jenis', 'proposal.component.jenis')
                ->addColumn('tipe', function($row) {
                    $badge = view('proposal.component.status', ['status' => $row->status->tipe]);
                    return $badge;
                })
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('mahasiswa.proposal.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('mahasiswa.proposal.edit', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('mahasiswa.proposal.destroy', $row->id)]);
                    return $show.$edit.$destroy;
                })
                ->rawColumns(['tipe', 'action'])
                ->make();
        }
        return view('mahasiswa.proposal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pendaftaran = Pendaftaran::proposal()->active()->get();
        return view('mahasiswa.proposal.form', compact('pendaftaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProposalRequest  $request
     * @param  \App\Services\ProposalService       $service
     * @return \Illuminate\Http\Response
     */
    public function store(ProposalRequest $request, ProposalService $service)
    {
        $request->validate(['dokumen' => 'required']);
        $pendaftaran = Pendaftaran::find($request->pendaftaran_id);
        if ($pendaftaran->akhir < now()) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('proposal.messages.errors.expired'),
            ]);
        }

        $mahasiswa = auth()->user()->mahasiswa;
        $fields = $request->all();
        $fields['mahasiswa_id'] = $mahasiswa->id;

        if ($request->hasFile('dokumen')) {
            $fileName = $this->uploadFile($request->file('dokumen'), $fields['judul'], $this->file_path.$mahasiswa->nim);
            $fields['dokumen'] = $fileName;
        }

        if ($service->create($fields)) {
            return redirect()->route('mahasiswa.proposal.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('proposal.messages.success.create'),
            ]);
        }

        if (isset($fields['dokumen'])) {
            $this->deleteFile($fileName);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('proposal.messages.errors.create'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        return view('mahasiswa.proposal.show', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proposal $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        $pendaftaran = Pendaftaran::proposal()->active()->get();
        return view('mahasiswa.proposal.form', compact('pendaftaran', 'proposal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProposalRequest  $request
     * @param  \App\Models\Proposal                $proposal
     * @param  \App\Services\ProposalService       $service
     * @return \Illuminate\Http\Response
     */
    public function update(ProposalRequest $request, Proposal $proposal, ProposalService $service)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $fields = $request->all();
        $fields['mahasiswa_id'] = $mahasiswa->id;
        $old_file = $proposal->dokumen;

        if ($request->hasFile('dokumen')) {
            $fileName = $this->uploadFile($request->file('dokumen'), $fields['judul'], $this->file_path.$mahasiswa->nim);
            $fields['dokumen'] = $fileName;
        }

        if ($service->update($proposal, $fields)) {
            if ($request->hasFile('dokumen')) {
                $this->deleteFile($old_file);
            }

            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('proposal.messages.success.update'),
            ]);
        }

        if (isset($fields['dokumen'])) {
            $this->deleteFile($fileName);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('proposal.messages.errors.update'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Services\ProposalService $service
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

        if ($proposal->status->tipe == "Disetujui") {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('proposal.messages.errors.approved'),
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

}
