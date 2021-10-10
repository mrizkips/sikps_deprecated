<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LandingPageController extends Controller
{
    /**
     * Display landingpage view.
     */
    public function index()
    {
        return view('landingpage');
    }

    /**
     * Display listing of proposal.
     *
     * @param   \Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function proposal(Request $request)
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
                ->rawColumns(['tipe'])
                ->make();
        }
        return redirect()->back();
    }
}
