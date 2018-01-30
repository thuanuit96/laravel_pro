<?php

namespace App\Http\Controllers;

use App\Services\DomainService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if (!empty(DomainService::getPendingDomain())) {
    	    return redirect()->action('Dashboard\NameManagementController@index');
	    }

        return view('dashboard/index');
    }
}
