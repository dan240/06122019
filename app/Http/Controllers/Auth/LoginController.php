<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Socialite;
use Exception;
use Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
     
    /**
     * Obtain the user information from Facebook.
     *
     * @return void
     */
     public function handleProviderFacebookCallback()
    {
        //$response = array();
        $data = Socialite::driver('facebook')->user(); // Fetch authenticated user

        return view('frontend/signup')->with('data',$data->user);
    }

    public function redirectToLinkedinProvider()
    {
        return Socialite::driver('linkedin')->redirect();
    }
     
    /**
     * Obtain the user information from Facebook.
     *
     * @return void
     */
    public function handleProviderLinkedinCallback()
    {
        //$response = array();
        $data = Socialite::driver('linkedin')->user(); // Fetch authenticated user

        return view('frontend/signup')->with('data',$data->user);
    }

}
