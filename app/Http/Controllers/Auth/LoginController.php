<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\UserCompany;
use App\UserInvestor;
use Socialite;
use Exception;
use Auth;
use Session;

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

    protected $user;
    protected $user_data;

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
        $this->user_data = Socialite::driver('facebook')->user();

        return $this->handleSocialLogin();
    }

    public function redirectToLinkedinProvider()
    {
        return Socialite::driver('linkedin')->redirect();
    }
     
    /**
     * Obtain the user information from LinkedIn.
     *
     * @return void
     */
    public function handleProviderLinkedinCallback()
    {
        $this->user_data = Socialite::driver('linkedin')->user();

        return $this->handleSocialLogin();
    }

    protected function handleSocialLogin() {
        $this->user = User::where('email', $this->user_data->getEmail())->first();
        
        if ($this->user) {
            $user_avatar = $this->user_data->getAvatar();

            if ($user_avatar) {
                $user_details = User::find($this->user->id)->investorDetail;

                if (!$user_details) {
                    $user_details = User::find($this->user->id)->companyDetail;
                }

                $folderName = '/uploads/images/';
                $destinationPath = public_path() . $folderName;
                
                // echo "<pre>";
                // print_r($destinationPath . $user_details->image_name);
                // print_r(file_exists($destinationPath . $user_details->image_name)); 
                // die();

                if (file_exists($destinationPath . $user_details->image_name) == false) {
                    $image = file_get_contents($user_avatar);
                    
                    $safeName = str_random(10).'.'.'png';
                    
                    $avatar_upload = file_put_contents($destinationPath . $safeName, $image);

                    if ($avatar_upload) {
                        $user_details->image_name = $safeName;
                        $user_details->save();
                    }
                }
            }
            
            if ($this->user->email_verification == 'inactive') {	
                $redirect_url = 'User/emailnotverified/?id=' . $this->user->id;

                return redirect($redirect_url);
            }

            $activation_date = $this->user->activation;
            $current_date = date('Y-m-d');

            $days = strtotime($activation_date) - strtotime($current_date);

            $count_days = $days / (60 * 60 * 24);
            
            Session::put('days', $count_days);
            Session::put('User', $this->user->toArray());

            $this->user->last_login = date('Y-m-d');
            $this->user->userip = \Request::ip();
            $this->user->save();
            
            if ($this->user->usertype == '1') {
                return redirect('User/browse-investors');
            } else if ($this->user->usertype == '2') {
                return redirect('User/index');
            }
            
        } else {
            $view_user_data = array(
                "name" => $this->user_data->getName(),
                "email" => $this->user_data->getEmail()
            );

            return view('frontend/signup')->with('data', $view_user_data);
        }
    }
}