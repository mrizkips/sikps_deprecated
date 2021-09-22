<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
use App\Services\DosenService;

class ProfilController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  Dosen $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\DosenRequest  $request
     * @param  Dosen $dosen
     * @param  DosenService $service
     * @return \Illuminate\Http\Response
     */
    public function update(DosenRequest $request, Dosen $dosen, DosenService $service)
    {
        $fields = $request->all();
        if (isset($fields['password'])) {
            $request->validate([
                'password' => ['required', 'string', 'min:4', 'confirmed']
            ]);
        }

        if ($service->update($dosen, $fields)) {
            return redirect()->back()->with('flash_messages', [
                'type' => 'success',
                'message' => trans('dosen.messages.success.update'),
            ]);
        }

        return redirect()->back()->withInput()->with('flash_messages', [
            'type' => 'danger',
            'message' => trans('dosen.messages.errors.update'),
        ]);
    }
}
