<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Requests;

class DashboardController extends Controller
{
    /**
     * Administrator welcome page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('administrator.welcome');
    }
}
