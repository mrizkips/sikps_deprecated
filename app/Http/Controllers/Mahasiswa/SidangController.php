<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SidangRequest;
use App\Models\Pendaftaran;
use App\Models\Proposal;
use App\Models\Sidang;
use App\Services\SidangService;
use App\Traits\Uploadable;
use Yajra\DataTables\Facades\DataTables;

class SidangController extends Controller
{
    use Uploadable;

    /**
     * Upload file path variable.
     *
     * @var string
     */
    protected $file_path = 'sidang/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $proposal = Proposal::where('mahasiswa_id', auth()->user()->mahasiswa->id)->get();
        foreach ($proposal as $key => $value) {
            $list[$key] = $value->id;
        }

        if ($request->ajax()) {
            $sidang = Sidang::query()->with(['proposal.dosen.user', 'proposal.mahasiswa.user', 'status', 'pendaftaran'])->whereIn('proposal_id', $list)->select('sidang.*');
            return DataTables::eloquent($sidang)
                ->addIndexColumn()
                ->editColumn('jenis', 'components.sidang.jenis')
                ->addColumn('tipe', function($row) {
                    $badge = view('components.status', ['status' => $row->status->tipe]);
                    return $badge;
                })
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('mahasiswa.sidang.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('mahasiswa.sidang.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('mahasiswa.sidang.destroy', $row->id)]);
                    return $show.$edit.$delete;
                })
                ->rawColumns(['tipe', 'action'])
                ->make();
        }
        return view('mahasiswa.sidang.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            return $this->getProposal($request->jenis);
        }

        $proposal = Proposal::approved()->where('mahasiswa_id', auth()->user()->mahasiswa->id)->get();
        $pendaftaran = Pendaftaran::sidang()->active()->get();
        return view('mahasiswa.sidang.form', compact('proposal', 'pendaftaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SidangRequest  $request
     * @param  \App\Services\SidangService       $service
     * @return \Illuminate\Http\Response
     */
    public function store(SidangRequest $request, SidangService $service)
    {
        $request->validate([
            'laporan' => 'required',
            'penilaian_kp' => 'required_if:jenis,3',
        ]);

        $pendaftaran = Pendaftaran::find($request->pendaftaran_id);
        if (!$pendaftaran->akhir >= today()) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('sidang.messages.errors.expired'),
            ]);
        }

        $proposal = Proposal::find($request->proposal_id);
        if ($this->isDuplicate($pendaftaran, $proposal)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('sidang.messages.errors.duplicate'),
            ]);
        }

        $mahasiswa = auth()->user()->mahasiswa;
        $fields = $request->all();

        if ($request->hasFile('laporan')) {
            $fileName = $this->uploadFile($request->file('laporan'), "{$proposal->judul} - ".date_format_id($pendaftaran->tanggal_kontrak), $this->file_path.$mahasiswa->nim);
            $fields['laporan'] = $fileName;
        }

        if ($request->hasFile('penilaian_kp')) {
            $fileName = $this->uploadFile($request->file('penilaian_kp'), "Form penilaian KP {$mahasiswa->nim} - ".date_format_id($pendaftaran->tanggal_kontrak), $this->file_path.$mahasiswa->nim);
            $fields['penilaian_kp'] = $fileName;
        }

        if ($service->create($fields)) {
            return redirect()->route('mahasiswa.sidang.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('sidang.messages.success.create'),
            ]);
        }

        if (isset($fields['laporan'])) {
            $this->deleteFile($fileName);
        }

        if (isset($fields['penilaian_kp'])) {
            $this->deleteFile($fileName);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('sidang.messages.errors.create'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sidang $sidang
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Sidang $sidang)
    {
        return view('mahasiswa.sidang.show', compact('sidang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request     $request
     * @param  \App\Models\Sidang           $sidang
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Sidang $sidang)
    {
        if ($request->ajax()) {
            return $this->getProposal($request->jenis);
        }

        $proposal = Proposal::approved()->where('mahasiswa_id', auth()->user()->mahasiswa->id)->get();
        $pendaftaran = Pendaftaran::sidang()->active()->get();
        return view('mahasiswa.sidang.form', compact('proposal', 'pendaftaran', 'sidang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SidangRequest  $request
     * @param  \App\Models\Sidang                $sidang
     * @param  \App\Services\SidangService       $service
     * @return \Illuminate\Http\Response
     */
    public function update(SidangRequest $request, Sidang $sidang, SidangService $service)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $proposal = Proposal::find($request->proposal_id);
        $pendaftaran = Pendaftaran::find($request->pendaftaran_id);
        $fields = $request->all();

        if ($request->hasFile('laporan')) {
            $fileName = $this->uploadFile($request->file('laporan'), "{$proposal->judul} - ".date_format_id($pendaftaran->tanggal_kontrak), $this->file_path.$mahasiswa->nim);
            $fields['laporan'] = $fileName;
        }

        if ($request->hasFile('penilaian_kp')) {
            $fileName = $this->uploadFile($request->file('penilaian_kp'), "Form penilaian KP {$mahasiswa->nim} - ".date_format_id($pendaftaran->tanggal_kontrak), $this->file_path.$mahasiswa->nim);
            $fields['penilaian_kp'] = $fileName;
        }

        if ($service->update($sidang, $fields)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('sidang.messages.success.update'),
            ]);
        }

        if (isset($fields['laporan'])) {
            $this->deleteFile($fileName);
        }

        if (isset($fields['penilaian_kp'])) {
            $this->deleteFile($fileName);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('sidang.messages.errors.update'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Services\SidangService $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, SidangService $service)
    {
        if (!$sidang = Sidang::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('sidang.messages.errors.not_found'),
            ]);
        }

        if ($sidang->status->tipe == "1") {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('sidang.messages.errors.approved'),
            ]);
        }

        if ($service->delete($sidang)) {
            if (isset($sidang->penilaian_kp)) {
                $this->deleteFile($sidang->penilaian_kp);
            }
            $this->deleteFile($sidang->laporan);

            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('sidang.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('sidang.messages.errors.delete'),
        ]);
    }

    /**
     * Get proposal by jenis.
     *
     * @param int $jenis
     * @return mixed
     */
    protected function getProposal($jenis)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $html = "<option>".trans('sidang.placeholders.proposal_id')."</option>";

        if ($jenis == 3) {
            $proposal = Proposal::approved()->kp()->where('mahasiswa_id', $mahasiswa->id)->get();
        } else if ($jenis == 1 || $jenis == 2) {
            $proposal = Proposal::approved()->skripsi()->where('mahasiswa_id', $mahasiswa->id)->get();
        }

        if (isset($proposal)) {
            foreach ($proposal as $value) {
                $html .= "<option value='{$value->id}'>{$value->judul}</option>";
            }
        }

        return $html;
    }

    /**
     * Check proposal duplication in the same pendaftaran.
     *
     * @param \App\Models\Pendaftaran $pendaftaran
     * @param \App\Models\Proposal $proposal
     * @return bool
     */
    protected function isDuplicate(Pendaftaran $pendaftaran, Proposal $proposal)
    {
        $count = Sidang::where([
            ['pendaftaran_id', $pendaftaran->id],
            ['proposal_id', $proposal->id],
        ])->count();

        return ($count > 0);
    }
}
