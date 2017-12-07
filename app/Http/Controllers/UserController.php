<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //

  /**
   * @return \Illuminate\Database\Eloquent\Collection|static[]
   */
    public function show(User $user){

        return view('users.show',compact('user'));

     //$users = User::all();
     //return $users;
    }


  /**
   * @param \App\User $user
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
    public function edit(User $user){
      return view('users.edit',compact('user'));
    }

  /**
   * @param \App\Http\Requests\UserFormRequest $request
   * @param \App\User $user
   * @return \Illuminate\Http\RedirectResponse
   */
    public function save(UserFormRequest $request, User $user){
      $birth_date = sprintf('%s-%s-%s', $request->input('day'), $request->input('month'), $request->input('year'));

      if(
        $request->has('password') &&
        $request->input('password') != '' &&
        ($request->input('password') == $request->input('password_confirmation')) &&
        $request->input('password') !== null
      ){
        $password = ['password' => bcrypt($request->input('password'))];
      }else {
        $password = [];
      }

      $user->update(array_merge($request->except([
        '_token',
        '_method',
        'day',
        'month',
        'year',
        'password',
        'password_confirmation'
      ]), ['birth_date' => $birth_date], $password));

      return redirect(route('account.edit', ['user' => $user]))->with([
        'message' => 'You\'ve successfully updated your profile']);

    }
}

