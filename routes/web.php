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


/**================================
 * BASIC AUTH
=================================*/
Auth::routes();

/**================================
 * LINKEDIN
=================================*/
Route::get('linkedin', function () {
  return view('login');
});
Route::get('auth/linkedin', 'Auth\LoginController@redirectToLinkedin');
Route::get('auth/linkedin/callback', 'Auth\LoginController@handleLinkedinCallback');

/**================================
 * Frontpage / User home page == same page
=================================*/
Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', function(){
  return view('welcome');
})->name('home');

/**================================
 * JOBS FEED
 =================================*/
Route::group([
  'prefix' => 'jobs'
], function() {

  Route::get('/','XmlController@JobsFeed')->name('feeds.jobs');
  Route::get('/{job}','XmlController@getJob')->name('jobAd');

});

/**================================
 * NEWS FEED
=================================*/
Route::get('/news', 'XmlController@NewsFeed')->name('feeds.news');

/**================================
 * CONTACTS FEED
=================================*/
Route::get('/contact', 'XmlController@ContactsFeed')->name('contact');


/**================================
 * USER PROFILE FEED
=================================*/
Route::group([
  'prefix' => 'user',
  'middleware' => ['auth']
], function(){

    Route::get('{user}', 'UserController@show')->name('account.show');
  Route::get('profile/{user}', 'UserController@edit')->name('account.edit');
  Route::put('profile/{user}', 'UserController@save')->name('account.save');

});