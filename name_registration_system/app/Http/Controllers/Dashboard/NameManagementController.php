<?php

namespace App\Http\Controllers\Dashboard;

use App\DomainName;
use App\Http\Controllers\Controller;
use App\Services\DomainService;
use Illuminate\Http\Request;
use DB;

class NameManagementController extends Controller
{
	public function index()
	{
		return view('dashboard.names.index');
	}

	public function searchDomain(Request $request) {
		$name = $request->get('search');

		$expected = DomainName::where('name', '=', $name)->first();
		$similars = DomainName::where( 'id', '!=', empty($expected) ? 0 : $expected->id )->where( 'name', 'like', '%' . $name . '%' )->get();
		return back()->with( 'results', $reponse = [
			'keyword'	=> $name,
			'expected' 	=> $expected,
			'similars'  => $similars
		]);
	}

	public function create(Request $request) {
		$name = $request->get('name');
		if (empty($name)) {
			$name = DomainService::getPendingDomain();
			DomainService::removePendingDomain();
		}
		if (empty($name))
			return redirect()->action('Dashboard\NameManagementController@index')
				->withErrors(['error' => 'Please select name first!']);

		return view('dashboard.names.create', compact('name'));
	}

	public function store(Request $request) {
		$input = $request->all();
		$validate = DomainService::validate($input);
		if ($validate->fails()) {
			return redirect()->action('Dashboard\NameManagementController@index')
			                 ->with('error', 'Domain existed!');
		}

		if (DomainService::create($input)) {
			return redirect()->action('DomainController@index')->with('message', 'Create successfully.');
		}

		return redirect()->action('DomainController@index')->with('error', 'Error has occurred.');
	}
}
