<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;



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
    protected $redirectTo = '/home';
    //protected $dates = ['birth_date'];
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
            'day' => 'required', //birth_date
            'month' => 'required',//birth_date
            'year' => 'required',//birth_date
            'user_city' => 'required|string|max:255',
            'user_country' => 'required|string|max:255',
            'languages' => 'required|string',
            'competences' => 'required|string',
            'phone_number' => 'between:0,8',

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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'birth_date' => $data['day'] . '-' . $data['month'] . '-' . $data['year'],
            'user_city' => $data['user_city'],
            'user_country' =>$data['user_country'],
            'languages' => $data['languages'],
            'competences' => $data['competences'],
            'phone_number' => $data['phone_number'],
            'is_available' => isset($data['is_available']) ? 1 : 0, //to check if the checkbox is checked then set the field to 1.
            'is_freelancer' => isset($data['is_freelancer']) ? 1 : 0,
            'is_permanent' => isset($data['is_permanent']) ? 1 : 0,
            'password' => bcrypt($data['password']),
        ]);
    }
}
