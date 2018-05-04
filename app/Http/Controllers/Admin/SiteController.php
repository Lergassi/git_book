<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homepage()
    {
        return view('admin/site/homepage');
    }
}
