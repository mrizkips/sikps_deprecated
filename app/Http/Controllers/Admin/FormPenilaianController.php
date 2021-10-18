<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormPenilaianRequest;
use App\Models\FormPenilaian;
use Yajra\DataTables\Facades\DataTables;

class FormPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $form_penilaian = FormPenilaian::query()->select('form_penilaian.*');
            return DataTables::eloquent($form_penilaian)
                ->addIndexColumn()
                ->editColumn('jenis', function(FormPenilaian $form_penilaian) {
                    return FormPenilaian::JENIS[$form_penilaian->jenis];
                })
                ->editColumn('penilai', function(FormPenilaian $form_penilaian) {
                    return FormPenilaian::PENILAI[$form_penilaian->penilai];
                })
                ->addColumn('action', function($row) {
                    $show = view('components.show', ['url' => route('admin.form_penilaian_item.index', $row->id)]);
                    $edit = view('components.edit', ['url' => route('admin.form_penilaian.edit', $row->id)]);
                    $delete = view('components.delete', ['url' => route('admin.form_penilaian.destroy', $row->id)]);
                    return $show.$edit.$delete;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.form_penilaian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = FormPenilaian::JENIS;
        $penilai = FormPenilaian::PENILAI;
        return view('admin.form_penilaian.form', compact('jenis', 'penilai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FormPenilaianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormPenilaianRequest $request)
    {
        $fields = $request->all();
        if (FormPenilaian::create($fields)) {
            return redirect()->route('admin.form_penilaian.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('form_penilaian.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('form_penilaian.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormPenilaian $form_penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(FormPenilaian $form_penilaian)
    {
        $jenis = FormPenilaian::JENIS;
        $penilai = FormPenilaian::PENILAI;
        return view('admin.form_penilaian.form', compact('jenis', 'penilai', 'form_penilaian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FormPenilaianRequest  $request
     * @param  \App\Models\FormPenilaian $form_penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(FormPenilaianRequest $request, FormPenilaian $form_penilaian)
    {
        $fields = $request->all();
        if ($form_penilaian->update($fields)) {
            return redirect()->route('admin.form_penilaian.index')->with('flash_messages', [
                'type' => 'success',
                'message' => trans('form_penilaian.messages.success.update'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('form_penilaian.messages.errors.update'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$form_penilaian = FormPenilaian::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('form_penilaian.messages.errors.not_found'),
            ]);
        }

        if($form_penilaian->delete($form_penilaian)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('form_penilaian.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('form_penilaian.messages.errors.delete'),
        ]);
    }
}
