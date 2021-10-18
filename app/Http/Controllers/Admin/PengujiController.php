<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PengujiRequest;
use App\Models\Dosen;
use App\Models\Penguji;
use App\Models\Pengujian;
use App\Services\PengujianService;
use Illuminate\Validation\Rule;

class PengujiController extends Controller
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
        if ($service->pengujiIsFull($pengujian)) {
            return redirect()->back()->withInput()->with('flash_messages', [
                'type' => 'warning',
                'message' => trans('penguji.messages.errors.is_full'),
            ]);
        }

        $dosen = Dosen::select('id','user_id')->with('user:id,nama')->where('id', '!=', $pengujian->sidang->proposal->dosen_id)->get();
        return view('admin.penguji.form', compact('pengujian', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PengujiRequest  $request
     * @param  \App\Models\Pengujian $pengujian
     * @param  \App\Services\PengujianService $service
     * @return \Illuminate\Http\Response
     */
    public function store(PengujiRequest $request, Pengujian $pengujian, PengujianService $service)
    {
        $fields = $request->validated();

        if ($service->pengujiIsFull($pengujian)) {
            return redirect()->back()->withInput()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('penguji.messages.errors.is_full'),
            ]);
        }

        if ($service->pembimbingEqualPenguji($fields['dosen_id'], $pengujian->sidang_id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('penguji.messages.errors.is_pembimbing'),
            ]);
        }

        if ($service->createPenguji($fields, $pengujian)) {
            return redirect()->route('admin.pengujian.show', $pengujian)->with('flash_messages', [
                'type' => 'success',
                'message' => trans('penguji.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('penguji.messages.errors.create'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengujian $pengujian
     * @param  \App\Models\Penguji $penguji
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengujian $pengujian, Penguji $penguji)
    {
        $dosen = Dosen::select('id','user_id')->with('user:id,nama')->where('id', '!=', $pengujian->sidang->proposal->dosen_id)->get();
        return view('admin.penguji.form', compact('pengujian', 'dosen', 'penguji'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PengujiRequest  $request
     * @param  \App\Models\Pengujian $pengujian
     * @param  \App\Models\Penguji $penguji
     * @param  \App\Services\PengujianService $service
     * @return \Illuminate\Http\Response
     */
    public function update(PengujiRequest $request, Pengujian $pengujian, Penguji $penguji, PengujianService $service)
    {
        $fields = $request->validated();

        if ($service->pembimbingEqualPenguji($fields['dosen_id'], $pengujian->sidang_id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('penguji.messages.errors.is_pembimbing'),
            ]);
        }

        if ($service->editPenguji($fields, $penguji)) {
            return redirect()->route('admin.pengujian.show', $pengujian)->with('flash_messages', [
                'type' => 'success',
                'message' => trans('penguji.messages.success.create'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('penguji.messages.errors.create'),
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
        if (!$penguji = Penguji::find($id)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'danger',
                'message' => trans('penguji.messages.errors.not_found'),
            ]);
        }

        if($service->deletePenguji($penguji)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('penguji.messages.success.delete'),
            ]);
        }

        return redirect()->back()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('penguji.messages.errors.delete'),
        ]);
    }
}
