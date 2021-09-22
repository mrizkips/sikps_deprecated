<?php

namespace App\Http\Controllers\Baak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PetugasRequest;
use App\Models\Baak;
use App\Services\PetugasService;

class ProfilController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Baak  $baak
     * @return \Illuminate\Http\Response
     */
    public function show(Baak $baak)
    {
        return view('baak.show', compact('baak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Baak  $baak
     * @return \Illuminate\Http\Response
     */
    public function edit(Baak $baak)
    {
        return view('baak.edit', compact('baak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PetugasRequest  $request
     * @param  Baak $baak
     * @param  PetugasService $service
     * @return \Illuminate\Http\Response
     */
    public function update(PetugasRequest $request, Baak $baak, PetugasService $service)
    {
        $fields = $request->all();
        if (isset($fields['password'])) {
            $request->validate([
                'password' => ['required', 'string', 'min:4', 'confirmed']
            ]);
        }

        if ($service->update($baak->user_id, $fields)) {
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
