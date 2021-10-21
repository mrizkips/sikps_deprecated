<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PenilaianRequest;
use App\Models\Pengujian;
use App\Models\Penilaian;
use App\Services\PengujianService;

class PenilaianController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Pengujian $pengujian
     * @param  \App\Services\PengujianService $service
     * @return \Illuminate\Http\Response
     */
    public function create(Pengujian $pengujian, PengujianService $service)
    {
        $form_penilaian = $service->checkFormPenilaian(auth()->user(), $pengujian);
        $count = Penilaian::where([
            ['pengujian_id', $pengujian->id],
            ['form_penilaian_id', $form_penilaian->id],
        ])->count();

        if ($count > 0) {
            return redirect()->route('admin.pengujian.show', $pengujian)->with('flash_messages', [
                'type' => 'warning',
                'message' => trans('penilaian.messages.errors.is_existed'),
            ]);
        }

        return view('admin.penilaian.form', compact('form_penilaian', 'pengujian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PenilaianRequest  $request
     * @param  \App\Models\Pengujian $pengujian
     * @param  \App\Services\PengujianService $service
     * @return \Illuminate\Http\Response
     */
    public function store(PenilaianRequest $request, Pengujian $pengujian, PengujianService $service)
    {
        $fields = $request->all();
        if ($service->addPenilaian($fields, $pengujian)) {
            return redirect()->route('admin.pengujian.show', $pengujian)->with('flash_messages', [
                'type' => 'success',
                'message' => trans('penilaian.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('penilaian.messages.errors.create'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengujian $pengujian
     * @param  \App\Models\Penilaian $penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengujian $pengujian, Penilaian $penilaian)
    {
        return view('admin.penilaian.show', compact('pengujian', 'penilaian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Pengujian $pengujian
     * @param  \App\Models\Penilaian $penilaian
     * @param  \App\Services\PengujianService $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengujian $pengujian, Penilaian $penilaian, PengujianService $service)
    {
        $form_penilaian = $service->checkFormPenilaian(auth()->user(), $pengujian);
        return view('admin.penilaian.form', compact('form_penilaian', 'pengujian', 'penilaian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PenilaianRequest  $request
     * @param  \App\Models\Pengujian $pengujian
     * @param  \App\Models\Penilaian $penilaian
     * @param  \App\Services\PengujianService $service
     * @return \Illuminate\Http\Response
     */
    public function update(PenilaianRequest $request, Pengujian $pengujian, Penilaian $penilaian, PengujianService $service)
    {
        $fields = $request->all();
        if ($service->editPenilaian($fields, $penilaian)) {
            return redirect()->route('admin.pengujian.show', $pengujian)->with('flash_messages', [
                'type' => 'success',
                'message' => trans('penilaian.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('penilaian.messages.errors.create'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengujian $pengujian
     * @param  int  $id
     * @param  \App\Services\PengujianService $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengujian $pengujian, $id, PengujianService $service)
    {
        if (!$penilaian = Penilaian::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('penilaian.messages.errors.not_found'),
            ]);
        }

        if($service->deletePenilaian($penilaian)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('penilaian.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('penilaian.messages.errors.delete'),
        ]);
    }
}
