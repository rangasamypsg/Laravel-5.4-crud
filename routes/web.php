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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::group(['middleware' => ['web']], function () {
	
	Route::group(['middleware' => ['auth']], function () {

		//Route::get('registrations', ['as' => 'Registration.index' , 'uses' => 'RegistrationController@index']);
		
		//Route::resource('registrations', 'RegistrationController');
				
	});
	
//});


//Register resource 	
	Route::get('registrations', ['as' => 'Registration.index' , 'uses' => 'RegistrationController@index']);
	Route::get('registration/create', ['as' => 'Registration.create' , 'uses' => 'RegistrationController@create']);
	Route::post('registration/store', ['as' => 'Registration.store' , 'uses' => 'RegistrationController@store']);
	Route::get('registration/show/{id}', ['as' => 'Registration.show' , 'uses' => 'RegistrationController@show']);
	Route::get('registration/{id}/edit', ['as' => 'Registration.edit' , 'uses' => 'RegistrationController@edit']);
	Route::post('registration/update/{id}', ['as' => 'Registration.update' , 'uses' => 'RegistrationController@update']);
	Route::delete('registration/destroy/{id}', ['as' => 'Registration.destroy' , 'uses' => 'RegistrationController@destroy']);

	//Registration ajax routes...
	Route::post('registration/state', ['as' => 'Registration.state', 'uses' => 'RegistrationController@getStateList']);
	Route::post('registration/city', ['as' => 'Registration.city', 'uses' => 'RegistrationController@getCityList']);
	
	//Page not found
	Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'HomeController@pagenotfound']);	 