<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormPenilaianItemRequest;
use App\Models\FormPenilaian;
use App\Models\FormPenilaianItem;
use Yajra\DataTables\Facades\DataTables;

class FormPenilaianItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FormPenilaian $form_penilaian)
    {
        if ($request->ajax()) {
            $form_penilaian_item = FormPenilaianItem::query()->where('form_penilaian_id', $form_penilaian->id)->select('form_penilaian_item.*');
            return DataTables::eloquent($form_penilaian_item)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $edit = view('components.edit', ['url' => route('admin.form_penilaian_item.edit', ['form_penilaian' => $row->form_penilaian_id, 'form_penilaian_item' => $row->id])]);
                    $delete = view('components.delete', ['url' => route('admin.form_penilaian_item.destroy', ['form_penilaian' => $row->form_penilaian_id, 'form_penilaian_item' => $row->id])]);
                    return $edit.$delete;
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.form_penilaian_item.index', compact('form_penilaian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\FormPenilaian $form_penilaian
     * @return \Illuminate\Http\Response
     */
    public function create(FormPenilaian $form_penilaian)
    {
        return view('admin.form_penilaian_item.form', compact('form_penilaian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\FormPenilaianItemRequest  $request
     * @param  \App\Models\FormPenilaian $form_penilaian
     * @return \Illuminate\Http\Response
     */
    public function store(FormPenilaianItemRequest $request, FormPenilaian $form_penilaian)
    {
        $fields = $request->all();
        $fields['form_penilaian_id'] = $form_penilaian->id;

        if (FormPenilaianItem::create($fields)) {
            return redirect()->route('admin.form_penilaian_item.index', $form_penilaian->id)->with('flash_messages', [
                'type' => 'success',
                'message' => trans('form_penilaian_item.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('form_penilaian_item.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormPenilaian $form_penilaian
     * @param  \App\Models\FormPenilaianItem $form_penilaian_item
     * @return \Illuminate\Http\Response
     */
    public function edit(FormPenilaian $form_penilaian, FormPenilaianItem $form_penilaian_item)
    {
        return view('admin.form_penilaian_item.form', compact('form_penilaian', 'form_penilaian_item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\FormPenilaianItemRequest  $request
     * @param  \App\Models\FormPenilaian $form_penilaian
     * @param  \App\Models\FormPenilaianItem $form_penilaian_item
     * @return \Illuminate\Http\Response
     */
    public function update(FormPenilaianItemRequest $request, FormPenilaian $form_penilaian, FormPenilaianItem $form_penilaian_item)
    {

        $fields = $request->all();
        if ($form_penilaian_item->update($fields)) {
            return redirect()->route('admin.form_penilaian_item.index', $form_penilaian->id)->with('flash_messages', [
                'type' => 'success',
                'message' => trans('form_penilaian_item.messages.success.update'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('form_penilaian_item.messages.errors.update'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormPenilaian $form_penilaian
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormPenilaian $form_penilaian, $id)
    {
        if (!$form_penilaian_item = FormPenilaianItem::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('form_penilaian_item.messages.errors.not_found'),
            ]);
        }

        if($form_penilaian_item->delete($form_penilaian_item)) {
            return redirect()->route('admin.form_penilaian_item.index', $form_penilaian->id)->with('flash_messages', [
                'type' => 'success',
                'message' => trans('form_penilaian_item.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('form_penilaian_item.messages.errors.delete'),
        ]);
    }
}
