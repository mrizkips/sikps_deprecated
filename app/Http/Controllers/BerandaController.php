<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    /**
     * Show index view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('beranda');
    }
}
