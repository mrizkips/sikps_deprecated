<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BimbinganRequest;
use App\Models\Bimbingan;
use App\Models\Jadwal;
use App\Models\Proposal;
use App\Services\BimbinganService;
use Yajra\DataTables\Facades\DataTables;

class BimbinganController extends Controller
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
            $bimbingan = Bimbingan::query()->with(['proposal', 'mahasiswa.user', 'jadwal', 'dosen.user'])->where('mahasiswa_id', auth()->user()->mahasiswa->id)->select('bimbingan.*');
            return DataTables::eloquent($bimbingan)
                ->addIndexColumn()
                ->editColumn('jadwal.tanggal', function(Bimbingan $bimbingan) {
                    return date_format_id($bimbingan->jadwal->tanggal).", ".date('H:i', strtotime($bimbingan->jadwal->mulai))." - ".date('H:i', strtotime($bimbingan->jadwal->selesai));
                })
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('mahasiswa.bimbingan.show', $row->id)]);
                    $edit = view('components.edit', ['url' => route('mahasiswa.bimbingan.edit', $row->id)]);
                    $destroy = view('components.delete', ['url' => route('mahasiswa.bimbingan.destroy', $row->id)]);
                    return $show.$edit.$destroy;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('mahasiswa.bimbingan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $proposal = Proposal::where('mahasiswa_id', $mahasiswa->id)->get();
        foreach ($proposal as $key => $value) {
            $dosen[$key] = $value->dosen_id;
        }

        $jadwal = Jadwal::active()->whereIn('dosen_id', $dosen)->get();
        return view('mahasiswa.bimbingan.form', compact('jadwal', 'proposal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BimbinganRequest  $request
     * @param  \App\Services\BimbinganService $service
     * @return \Illuminate\Http\Response
     */
    public function store(BimbinganRequest $request, BimbinganService $service)
    {
        $jadwal = Jadwal::find($request->jadwal_id);
        if (!$this->pin_validation($jadwal, $request->pin)) {
            return redirect()->back()->withInput()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('bimbingan.messages.errors.pin'),
            ]);
        }

        $fields = $request->all();
        $fields['dosen_id'] = $jadwal->dosen_id;
        $mahasiswa = auth()->user()->mahasiswa;
        if ($service->create($fields, $mahasiswa)) {
            return redirect()->route('mahasiswa.bimbingan.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('bimbingan.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('bimbingan.messages.errors.create'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bimbingan $bimbingan
     * @return \Illuminate\Http\Response
     */
    public function show(Bimbingan $bimbingan)
    {
        return view('mahasiswa.bimbingan.show', compact('bimbingan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bimbingan $bimbingan
     * @return \Illuminate\Http\Response
     */
    public function edit(Bimbingan $bimbingan)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $proposal = Proposal::where('mahasiswa_id', $mahasiswa->id)->get();
        foreach ($proposal as $key => $value) {
            $dosen[$key] = $value->dosen_id;
        }

        $jadwal = Jadwal::active()->whereIn('dosen_id', $dosen)->get();
        return view('mahasiswa.bimbingan.form', compact('jadwal', 'proposal', 'bimbingan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BimbinganRequest  $request
     * @param  \App\Models\Bimbingan                $bimbingan
     * @param  \App\Services\BimbinganService       $service
     * @return \Illuminate\Http\Response
     */
    public function update(BimbinganRequest $request, Bimbingan $bimbingan, BimbinganService $service)
    {
        $jadwal = Jadwal::find($request->jadwal_id);
        if (!$this->pin_validation($jadwal, $request->pin)) {
            return redirect()->back()->withInput()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('bimbingan.messages.errors.pin'),
            ]);
        }

        $fields = $request->all();
        $fields['dosen_id'] = $jadwal->dosen_id;
        if ($service->update($fields, $bimbingan)) {
            return redirect()->route('mahasiswa.bimbingan.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('bimbingan.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('bimbingan.messages.errors.create'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  \App\Services\BimbinganService $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, BimbinganService $service)
    {
        if (!$bimbingan = Bimbingan::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('bimbingan.messages.errors.not_found'),
            ]);
        }

        if($service->delete($bimbingan)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('bimbingan.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('bimbingan.messages.errors.delete'),
        ]);
    }

    /**
     * Proposal request ajax
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function getProposal(Request $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        if ($request->ajax()) {
            $jadwal = Jadwal::find($request->jadwal_id);
            $html = "<option>".trans('bimbingan.placeholders.proposal_id')."</option>";

            if (isset($jadwal)) {
                $proposal = Proposal::where('mahasiswa_id', $mahasiswa->id)
                ->where('dosen_id', $jadwal->dosen_id)
                ->get();

                foreach ($proposal as $value) {
                    $html .= "<option value='{$value->id}'>{$value->judul}</option>";
                }
                return $html;
            }
            return $html;
        }
        return redirect()->back();
    }

    /**
     * Pin validation.
     *
     * @param  \App\Model\Jadwal $jadwal
     * @param  string $pin
     * @return bool
     */
    public function pin_validation(Jadwal $jadwal, $pin)
    {
        if ($jadwal->pin == $pin) {
            return true;
        }
        return false;
    }
}
