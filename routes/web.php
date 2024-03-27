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




Route::get('blog/create', 'App\Http\Controllers\BlogController@create')->name('blog.create');
Route::post('blog/save/{id?}', 'App\Http\Controllers\BlogController@save')->name('blog.save');
//Route::get('blog/index', 'App\Http\Controllers\BlogController@index')->name('blog.index');
Route::get('blog/show/{id}', 'App\Http\Controllers\BlogController@show')->name('blog.show');

//Route::get('/', function () {
   // return view('welcome');	
	Route::get('/', 'App\Http\Controllers\WelcomeController@index')->name('welcome');
//});
	
//Auth::routes();
	Route::group(['middleware'], function () {	
	

Route::get('blog/my_show/{id}', 'App\Http\Controllers\BlogController@my_show')->name('blog.my_show');		
Route::get('blog/my_index', 'App\Http\Controllers\BlogController@myindex')->name('blog.my_index');
Route::get('blog/delete/{id}', 'App\Http\Controllers\BlogController@delete')->name('blog.delete');
Route::get('blog/edit/{id}', 'App\Http\Controllers\BlogController@edit')->name('blog.edit');
Route::post('blog/update/{id}', 'App\Http\Controllers\BlogController@update')->name('blog.update');

//Users//
Route::get('user/index', 'App\Http\Controllers\UserController@index')->name('user.index');
Route::get('user/create/{id?}', 'App\Http\Controllers\UserController@create')->name('user.create');
Route::post('user/save/{id?}', 'App\Http\Controllers\UserController@save')->name('user.save');
Route::get('user/delete/{id}', 'App\Http\Controllers\UserController@delete')->name('user.delete');
Route::get('user/show/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');

// Job Notification

Route::get('notification/create', 'App\Http\Controllers\NotificationController@create')->name('notification.create');
Route::post('notification/save/{id?}', 'App\Http\Controllers\NotificationController@save')->name('notification.save');
Route::get('notification/index', 'App\Http\Controllers\NotificationController@index')->name('notification.index');
Route::get('notification/show/{id}', 'App\Http\Controllers\NotificationController@show')->name('notification.show');
Route::get('notification/delete/{id}', 'App\Http\Controllers\NotificationController@delete')->name('notification.delete');
Route::get('notification/edit/{id}', 'App\Http\Controllers\NotificationController@edit')->name('notification.edit');
Route::post('notification/update/{id}', 'App\Http\Controllers\NotificationController@update')->name('notification.update');	
Route::get('notification/my_index', 'App\Http\Controllers\NotificationController@my_index')->name('notification.my_index');



//Login form
Route::get('login', 'App\Http\Controllers\AuthenticateController@login')->name('authenticate.login');
Route::post('/authenticate/authenticate', 'App\Http\Controllers\AuthenticateController@authenticate')->name('authenticate.authenticate');
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