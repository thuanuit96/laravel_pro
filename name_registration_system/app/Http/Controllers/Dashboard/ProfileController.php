<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Request;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        return view('dashboard/profile/index',['name'=>$user->name]);
    }
    public function ChangeUserProfile()
    {
        $user = Auth::user();
        $name = Request::input('name');


        $user_id = $user->id;
        $obj_user = User::find($user_id);
        $obj_user->name = $name;
        $obj_user->save();

        return redirect('dashboard/profile');
    }
}
