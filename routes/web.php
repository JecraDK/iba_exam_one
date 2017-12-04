<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//to show one ID of users.
Route::get('/show','UserController@show');

//linkedin
Route::get('linkedin', function () {
    return view('login');
});
Route::get('auth/linkedin', 'Auth\LoginController@redirectToLinkedin');
Route::get('auth/linkedin/callback', 'Auth\LoginController@handleLinkedinCallback');