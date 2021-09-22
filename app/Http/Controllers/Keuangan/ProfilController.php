<?php

namespace App\Http\Controllers\Keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PetugasRequest;
use App\Models\Keuangan;
use App\Services\PetugasService;

class ProfilController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function show(Keuangan $keuangan)
    {
        return view('keuangan.show', compact('keuangan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Keuangan  $keuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Keuangan $keuangan)
    {
        return view('keuangan.edit', compact('keuangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PetugasRequest  $request
     * @param  Keuangan $keuangan
     * @param  PetugasService $service
     * @return \Illuminate\Http\Response
     */
    public function update(PetugasRequest $request, Keuangan $keuangan, PetugasService $service)
    {
        $fields = $request->all();
        if (isset($fields['password'])) {
            $request->validate([
                'password' => ['required', 'string', 'min:4', 'confirmed']
            ]);
        }

        if ($service->update($keuangan->user_id, $fields)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('petugas.messages.success.update'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('petugas.messages.errors.update'),
        ]);
    }
}
