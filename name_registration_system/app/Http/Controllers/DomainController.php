<?php

namespace App\Http\Controllers;

use App\DomainName;
use App\Services\DomainService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DomainController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'searchDomain', 'a'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    if (!empty(DomainService::getPendingDomain())) {
		    return redirect()->action('Dashboard\NameManagementController@index');
	    }

    	if (count(Auth::user()->domainNames) == 0) {
    		return redirect()->action('Dashboard\NameManagementController@index');
	    }

        $domains = DomainName::where("user_id","=",Auth::user()->id)->get();
        return view('domain.index', compact('domains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('domain.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validate = DomainService::validate($input);
        if ($validate->fails()) {
            return redirect()->action('DomainController@index')
                ->with('error', 'Domain existed!');
        }
        $domains = DomainName::all();
        foreach ($domains as $domain){
            if ($input['name'] == $domain['name']){
                return redirect()->action('DomainController@index')->with('error', 'Domain exists!');
            }
        }
        $input['user_id'] = Auth::user()->id;
        DomainName::create($input);

        return redirect()->action('DomainController@index')->with('message', 'Create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $domain = DomainName::findOrFail($id);
        return view('domain.edit', compact('domain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $domain = DomainName::findOrFail($id);

        $input = $request->all();

//        if($input['name'] == $domain->name){
//            return redirect()->action('DomainController@index');
//        }
//
//        $validate = DomainService::validate($input, $domain);
//        if ($validate->fails()) {
//            return redirect()->action('DomainController@index')
//                ->with('error', 'Domain existed!');
//        }

        if(DomainService::update($input, $domain)) {
            return redirect()->action('DomainController@index')->with('message', 'Edit successfully.');
        }

        return redirect()->action('DomainController@index')->with('error', 'Update failed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $domain = DomainName::findOrFail($id);

        $domain->delete();

        return redirect()->action('DomainController@index')->with('message', 'Delete successfully.');
    }

    public function searchDomain(Request $request){
        $input = $request->all();

        $domains = DomainName::all();
        foreach ($domains as $domain){
            if ($domain['name'] == $input['search']){
                return back()->with('error', 'Domain exists!');
            }
        }

        return back()->with('message', 'No match domain, do you want to register domain "'.$input['search'].'" ?')
            ->with('register-domain', $input['search']);
    }

    public function redirectNameManagement(Request $request){
        $input = $request->all();
        $domains = DomainName::all();
        foreach ($domains as $domain){
            if ($domain['name'] == $input['search']){
                return back()->with('error', 'Domain exists!');
            }
        }
        return view('dashboard.names.index')->with('input', $input['search']);
    }

    public function renew($domainId) {
		$domain = DomainName::find($domainId);
		if (!$domain->canRenew()) {
			return back()->withErrors(['error' => 'Can\'t renew this domain']);
		}

		DomainService::renew($domain);
	    return redirect()->action('DomainController@index')->with('message', 'Renew successfully');
    }
}
