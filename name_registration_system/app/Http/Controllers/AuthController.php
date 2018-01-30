<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{

	use AuthenticatesUsers;

	protected $redirectTo = '/home';

	public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
    public function index()
    {
        return view('auth/auth');
    }

    public function registerDomain($domainName)
    {
        return view('auth/auth', ['domainName'=>$domainName]);
    }
}
