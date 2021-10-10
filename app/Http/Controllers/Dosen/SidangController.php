<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proposal;
use App\Models\Sidang;
use App\Services\SidangService;
use Yajra\DataTables\Facades\DataTables;

class SidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $proposal = Proposal::where('dosen_id', auth()->user()->dosen->id)->get();
        $list = [];
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
                    $show = view('components.show', ['url' => route('dosen.sidang.show', $row->id)]);
                    return $show;
                })
                ->rawColumns(['tipe', 'action'])
                ->make();
        }
        return view('dosen.sidang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sidang $sidang
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Sidang $sidang)
    {
        return view('dosen.sidang.show', compact('sidang'));
    }

    /**
     * Approve or disapprove sidang.
     *
     * @param   \Illuminate\Http\Request $request
     * @param   \App\Models\Sidang $sidang
     * @param   \App\Services\SidangService $service
     * @return  \Illuminate\Http\Response
     */
    public function approval(Request $request, Sidang $sidang, SidangService $service)
    {
        $fields = $request->all();

        if ($request->tipe == "1") {
            $success = trans('sidang.messages.success.approve');
            $error = trans('sidang.messages.errors.approve');
        } else if ($request->tipe = "2") {
            $success = trans('sidang.messages.success.disapprove');
            $error = trans('sidang.messages.errors.disapprove');
        }

        if ($service->approval($sidang, $fields)) {
            return redirect()->route('dosen.sidang.index')->with('flash_messages', [
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
