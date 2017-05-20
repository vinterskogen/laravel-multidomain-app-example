<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show main page of site admin panel
     *
     * @return string
     */
    public function index(Request $request)
    {
        return "Wellcome! This is admin panel of site {$request->site()}.";
    }

}
