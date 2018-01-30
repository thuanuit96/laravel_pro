<?php

namespace App\Http\Controllers;

use App\DomainName;
use App\Services\DomainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ResultsController extends Controller
{
    public function index()
    {
        return view('results/index');
    }

    public function searchDomain(Request $request) {
	    $name = $request->get('search');

	    $expected = DomainName::where('name', '=', $name)->whereNotNull('user_id')->first();
	    $similars = DomainName::where( 'id', '!=', empty($expected) ? 0 : $expected->id )->where( 'name', 'like', '%' . $name . '%' )->get();
	    return redirect()->action('ResultsController@index')->with( 'results', $reponse = [
		    'keyword'	=> $name,
		    'expected' 	=> $expected,
		    'similars'  => $similars
	    ]);
    }

    public function registerDomain(Request $request) {
    	$name = $request->get('name');
	    DomainService::register($name);

	    if (Auth::check()) {
			return redirect()->action('Dashboard\NameManagementController@index');
	    }

		return redirect()->action('AuthController@registerDomain', [$name]);
    }
    public function ChangeDomain(Request $request) {
	    DomainService::removePendingDomain();
	    if (Auth::check()) {
			return redirect()->action('Dashboard\NameManagementController@index');
	    }

		return redirect()->action('HomeController@index');
    }
}
