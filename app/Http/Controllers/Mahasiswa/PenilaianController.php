<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Pengujian;
use App\Models\Penilaian;

class PenilaianController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengujian $pengujian
     * @param  \App\Models\Penilaian $penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengujian $pengujian, Penilaian $penilaian)
    {
        return view('mahasiswa.penilaian.show', compact('pengujian', 'penilaian'));
    }
}
