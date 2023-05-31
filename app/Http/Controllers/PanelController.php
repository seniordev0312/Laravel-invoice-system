<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    /**
     * Show the panel index page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('panel.index');
    }
}
