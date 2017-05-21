<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Site\Controller;

class HomeController extends Controller
{
    /**
     * Show main page site
     *
     * @return string
     */
    public function index(Request $request)
    {
        return "Wellcome! This is site {$request->site()}.";
    }
}
