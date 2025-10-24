<?php

use Illuminate\Support\Facades\Route;
use app\Helpers;

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

	// Job Portal
	
	Route::get('registration/add', 'App\Http\Controllers\ConferenceController@add')->name('conference.add');
	Route::post('registration/save/{id?}', 'App\Http\Controllers\ConferenceController@save')->name('conference.save');
	Route::get('/registration', 'App\Http\Controllers\ConferenceController@registration')->name('conference.registration');
	Route::get('registration/show/{id}', 'App\Http\Controllers\ConferenceController@show')->name('conference.show');
	
	
//Route::get('/', function () {
   // return view('welcome');	
//	Route::get('/', 'App\Http\Controllers\WelcomeController@index')->name('welcome');
//});
	
//Auth::routes();
Route::group(['middleware'], function () {	
	
	Route::get('registration/my_index', 'App\Http\Controllers\ConferenceController@myindex')->name('conference.my_index');
	Route::get('/registration', 'App\Http\Controllers\ConferenceController@registration')->name('conference.registration');
	Route::get('registration/delete/{id}', 'App\Http\Controllers\ConferenceController@delete')->name('conference.delete');
	Route::get('registration/edit/{id}', 'App\Http\Controllers\ConferenceController@edit')->name('conference.edit');
	Route::post('registration/update/{id}', 'App\Http\Controllers\ConferenceController@update')->name('conference.update');
	Route::get('registration/my_show/{id}', 'App\Http\Controllers\ConferenceController@my_show')->name('conference.my_show');

	// Users
	
	Route::get('user/index', 'App\Http\Controllers\UserController@index')->name('user.index');
	Route::get('/subscribers', 'App\Http\Controllers\UserController@subscribers')->name('user.subscribers');
	Route::get('user/create/{id?}', 'App\Http\Controllers\UserController@create')->name('user.create');
	Route::post('user/save/{id?}', 'App\Http\Controllers\UserController@save')->name('user.save');
	Route::get('user/delete/{id}', 'App\Http\Controllers\UserController@delete')->name('user.delete');
	Route::get('user/show/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');
 

	 
	
	//VV New Susbscription
	
	Route::get('subscriptions', 'App\Http\Controllers\NewSubscriptionController@index')->name('new_subscriptions');
	Route::get('new_subscription/create', 'App\Http\Controllers\NewSubscriptionController@create')->name('new_subscription.create');
	Route::get('subscription/add', 'App\Http\Controllers\NewSubscriptionController@create_new')->name('new_subscription.create_new');
	Route::get('subscription/renewal', 'App\Http\Controllers\NewSubscriptionController@create_renew')->name('new_subscription.create_renew');
	Route::post('new_subscription/save/{id?}', 'App\Http\Controllers\NewSubscriptionController@save')->name('new_subscription.save');
	Route::get('new_subscription/delete/{id}', 'App\Http\Controllers\NewSubscriptionController@delete')->name('new_subscription.delete');
	Route::get('new_subscription/show/{id}', 'App\Http\Controllers\NewSubscriptionController@show')->name('new_subscription.show');
	Route::get('new_subscription/export', 'App\Http\Controllers\NewSubscriptionController@export')->name('new_subscription.export');
	
	  
	
	
	//Login form
	Route::get('login', 'App\Http\Controllers\AuthenticateController@login')->name('authenticate.login');
	Route::get('vv_login', 'App\Http\Controllers\AuthenticateController@vv_login')->name('authenticate.vv_login');
	Route::post('/authenticate/authenticate', 'App\Http\Controllers\AuthenticateController@authenticate')->name('authenticate.authenticate');
	Route::post('/authenticate/vv_all', 'App\Http\Controllers\AuthenticateController@vv_all')->name('authenticate.vv_all');
	
	Route::get('/login/otp/{id}', 'App\Http\Controllers\AuthenticateController@loginOtp')->name('login.otp');
	Route::post('/login/verify_otp/{id}', 'App\Http\Controllers\AuthenticateController@loginVerifyOtp')->name('login.verify_otp');
	Route::get('/authenticate/logout', 'App\Http\Controllers\AuthenticateController@logout')->name('authenticate.logout');


	//Route::get('/login', [App\Http\Controllers\AuthenticateController::class, 'login'])->name('authenticate.login');
	//Route::post('/authentication/authenticte', [AuthenticateController::class, 'authenticate'])->name('authentication.authenticate');
	//Route::get('/authentication/logout', [AuthenticateController::class, 'logout'])->name('authenticate.logout');

	//Route::get('/login/otp/{id}', [AuthenticateController::class, 'loginOtp'])->name('login.otp');

	//Route::post('/login/verify_otp/{id}', [AuthenticateController::class,'loginVerifyOtp'])->name('login.verify_otp');

	Route::get('password/reset', [AuthenticateController::class,'showLinkRequestForm'])->name('password.request');
	Route::post('password/email', [AuthenticateController::class,'sendResetLinkEmail'])->name('password.email');
	Route::get('password/reset/{token}', [AuthenticateController::class,'showResetForm'])->name('password.reset');
	Route::post('password/reset', [AuthenticateController::class,'reset'])->name('password.update');


	
	Route::get('/signup/{id}', ['as' => 'signup', 'uses' => 'AuthController@signup']);
	Route::post('/signup/validate/{id}', ['as' => 'signup.validate', 'uses' => 'AuthController@validateSignup']);
	Route::get('/signup/otp/{type}', ['as' => 'signup.otp', 'uses' => 'AuthController@signupOtp']);
	Route::post('/signup/verify_otp/{type}', ['as' => 'signup.verify_otp', 'uses' => 'AuthController@signupVerifyOtp']);
	Route::get('/signout', ['as' => 'signout', 'uses' => 'AuthController@signout']);
	
	/* Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@loginPage']);
	Route::post('/login', ['as' => 'login', 'uses' => 'AuthController@login']);	
	Route::get('/login/otp', ['as' => 'login.otp', 'uses' => 'AuthController@loginOtp']);
	Route::post('/login/verify_otp', ['as' => 'login.verify_otp', 'uses' => 'AuthController@loginVerifyOtp']); */
	
	
	Route::group(['middleware' => 'checkUser'], function () {
		Route::get('/home', ['as' => 'home', 'uses' => 'AuthController@home']);
		
		
	
		 
	
	});
	
	
	
});
// File Download
    Route::get('/viewfile/{folder}/{filename}/{name?}', function ($folder, $filename, $name='')
    {
	  // var_dump($name); die();
       $filepath =  Storage::path("$folder/$filename");
	   $extension = pathinfo($filepath, PATHINFO_EXTENSION);
	   $name = !empty($name) ? "{$name}.{$extension}" : "File.{$extension}";
	   $headers = ['Content-Disposition' => "inline;filename={$name}"];
       return response()->file($filepath, $headers);
    })->name('viewfile');
	
	

    Route::get('/download/{folder}/{filename}/{name?}', function ($folder, $filename, $name=null) 
    {
       //$file =  Storage::get("$folder/$filename");
       $filepath =  Storage::path("$folder/$filename");
	   $exp = explode('.', $filepath);
	   $fname = ($name) ? $name.'.'.$exp[1] : 'file.'.$exp[1]; 
     //  return response($file, 200)->header('Content-Type', 'image/jpeg');	   
       return response()->download($filepath, $fname);
    })->name('download');