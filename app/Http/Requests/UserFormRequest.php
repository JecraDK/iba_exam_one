<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {


        if(Auth::user()->id == $this->route('user')->id){
          return true;
        }else {
          return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

      switch($this->method())
      {
        case 'GET':
        case 'DELETE':
            return [];
        break;


        case 'POST':

            return [
              'name' => 'required|string|max:255',
              'email' => 'required|string|email|max:255|unique:users,email,',
              'day' => 'required', //birth_date
              'month' => 'required',//birth_date
              'year' => 'required',//birth_date
              'user_city' => 'required|string|max:255',
              'user_country' => 'required|string|max:255',
              'languages' => 'required|string',
              'competences' => 'required|string',
              'phone_number' => 'between:0,8',
              'password' => 'required|string|min:6|confirmed',
            ];
          break;

          case 'PUT':
          case 'PATCH':

              return [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id() .',user_id',
                'day' => 'required', //birth_date
                'month' => 'required',//birth_date
                'year' => 'required',//birth_date
                'user_city' => 'required|string|max:255',
                'user_country' => 'required|string|max:255',
                'languages' => 'required|string',
                'competences' => 'required|string',
                'phone_number' => 'between:0,8',
              ];

          break;
          default: return []; break;
        }
    }
}
