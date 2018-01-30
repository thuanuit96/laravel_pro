<?php

namespace App\Http\Controllers\Auth;

use App\DomainName;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/domains';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $confirmation_code = str_random(30);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status' => 'not_verified',
            'confirmation_code' => $confirmation_code,
        ]);

        $mail_data = ['confirmation_code' => $confirmation_code, 'email' => $data['email'], 'name' => $data['name']];
        Mail::send('email.verify', $mail_data, function($message) use ($mail_data) {
            $message->to($mail_data['email'],$mail_data['name'])
                ->subject('Verify your email address');
        });
        return $user;

    }
    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            return redirect()->action('HomeController@index')
                ->with('error', 'Confirmation code is invalid!');
        }
        $user = User::where('confirmation_code',$confirmation_code)->first();
        if ( ! $user)
        {
            return redirect()->action('HomeController@index')
            ->with('error', 'User not found!');
        }

        $user->status = 'verified';
        $user->confirmation_code = null;
        $user->save();


       return redirect()->action('HomeController@index')
       ->with('message', 'You have successfully verified your account.');
    }
}
