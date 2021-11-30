<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sidang;
use App\Services\SidangService;
use Illuminate\Database\Eloquent\Builder;
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
        if ($request->ajax()) {
            $sidang = Sidang::query()->with(['proposal.dosen.user', 'proposal.mahasiswa.user', 'status', 'pendaftaran'])
            ->whereHas('status', function(Builder $query) {
                $query->whereHas('approval', function(Builder $query) {
                    $query->where([['role_id','3'],['tipe', '1']]);
                });
            })
            ->select('sidang.*');
            return DataTables::eloquent($sidang)
                ->addIndexColumn()
                ->editColumn('jenis', 'components.sidang.jenis')
                ->addColumn('tipe', function($row) {
                    $badge = view('components.status', ['status' => $row->status->tipe]);
                    return $badge;
                })
                ->addColumn('action', function($row) {
                    $approve = view('components.sidang.approve', ['url' => route('admin.sidang.approval', $row->id), 'id' => $row->id]);
                    $disapprove = view('components.sidang.disapprove', ['url' => route('admin.sidang.approval', $row->id), 'id' => $row->id]);
                    $show = view('components.show', ['url' => route('admin.sidang.show', $row->id)]);
                    $delete = view('components.delete', ['url' => route('admin.sidang.destroy', $row->id)]);
                    return $approve.$disapprove.$show.$delete;
                })
                ->rawColumns(['tipe', 'action'])
                ->make();
        }
        return view('admin.sidang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sidang $sidang
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Sidang $sidang)
    {
        return view('admin.sidang.show', compact('sidang'));
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
            return redirect()->route('admin.sidang.index')->with('flash_messages', [
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
