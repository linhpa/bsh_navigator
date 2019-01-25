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

//Auth::routes();

Route::get('login', [
  'as' => 'login',
  'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
  'as' => '',
  'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
  'as' => 'logout',
  'uses' => 'Auth\LoginController@logout'
]);

// Password Reset Routes...
Route::post('password/email', [
  'as' => 'password.email',
  'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
  'as' => 'password.request',
  'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
  'as' => '',
  'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
  'as' => 'password.reset',
  'uses' => 'Auth\ResetPasswordController@showResetForm'
]);

// Registration Routes...
Route::group(['middleware' => ['auth', 'admin']], function() {
	Route::get('register', [
	  'as' => 'register',
	  'uses' => 'Auth\RegisterController@showRegistrationForm'
	]);
	Route::post('register', [
	  'as' => '',
	  'uses' => 'Auth\RegisterController@register'
	]);
});

Route::group(['middleware' => ['auth']], function () {
	Route::get('change_pw', [
		'uses' => 'UserController@changePassword',
		'as' => 'change_pw'
	]);
	Route::post('change_pw', [
		'uses' => 'UserController@storeChangedPassword',
		'as' => 'change_pw.store'
	]);	

	Route::resource('bsh_cases', 'BshCaseController');
	Route::get('/bsh_cases/handle/{id}', 'BshCaseController@showHandleCase');
	Route::post('/bsh_cases/handle/', ['uses' => 'BshCaseController@handleCase', 'as' => 'bsh_cases.save']);

	Route::post('/bsh_cases/getGDVLocation/', 'BshCaseController@getGDVLocation');
	Route::post('/bsh_cases/complete/', 'BshCaseController@completeCase');	

	Route::post('/bsh_cases/uploadPhotos', 'BshCaseController@uploadPhotos');
	Route::delete('deleteCasePhoto', 'BshCaseController@destroyPhoto');
	Route::post('/bsh_cases/sendLocation', 'BshCaseController@sendLocation');

	Route::get('test', 'BshCaseController@test');
}); 	



Route::get('/home', 'HomeController@index')->name('home');
