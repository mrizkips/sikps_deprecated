<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
    /**
     * Show index view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.beranda');
    }
}
