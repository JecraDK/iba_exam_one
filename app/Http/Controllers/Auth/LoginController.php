<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;

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

    //linkedin login
    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedinCallback()
    {
        try {
            $user = Socialite::driver('linkedin')->user();
            $create['name'] = $user->name;
            $create['email'] = $user->email;
            $create['user_city'] = $user->user['location']['name'];
            $create['user_country'] = $user->user['location']['country']['code'];
            $create['password'] = $user->user['id'];

            $create['linkedin_id'] = $user->id;

            $userModel = new User;
           // dd($user);
            $createdUser = $userModel->create($create);

            Auth::loginUsingId($createdUser->user_id);
            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect('auth/linkedin');
        }
    }

}
