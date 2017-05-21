<?php

namespace App\Http\Controllers\MasterAdmin;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show main page of master admin panel
     *
     * @return string
     */
    public function index()
    {
        return 'Wellcome! This is master admin panel.';
    }
}
