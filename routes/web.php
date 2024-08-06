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
	
	Route::get('jobportal/create', 'App\Http\Controllers\BlogController@create')->name('blog.create');
	Route::post('jobportal/save/{id?}', 'App\Http\Controllers\BlogController@save')->name('blog.save');
	Route::get('/jobportal', 'App\Http\Controllers\BlogController@jobportal')->name('blog.jobportal');
	Route::get('jobportal/show/{id}', 'App\Http\Controllers\BlogController@show')->name('blog.show');
	
	
//Route::get('/', function () {
   // return view('welcome');	
//	Route::get('/', 'App\Http\Controllers\WelcomeController@index')->name('welcome');
//});
	
//Auth::routes();
Route::group(['middleware'], function () {	
	
	Route::get('jobportal/my_index', 'App\Http\Controllers\BlogController@myindex')->name('blog.my_index');
	Route::get('/jobportal', 'App\Http\Controllers\BlogController@jobportal')->name('blog.jobportal');
	Route::get('jobportal/delete/{id}', 'App\Http\Controllers\BlogController@delete')->name('blog.delete');
	Route::get('jobportal/edit/{id}', 'App\Http\Controllers\BlogController@edit')->name('blog.edit');
	Route::post('jobportal/update/{id}', 'App\Http\Controllers\BlogController@update')->name('blog.update');
	Route::get('jobportal/my_show/{id}', 'App\Http\Controllers\BlogController@my_show')->name('blog.my_show');

	// Users
	
	Route::get('user/index', 'App\Http\Controllers\UserController@index')->name('user.index');
	Route::get('user/create/{id?}', 'App\Http\Controllers\UserController@create')->name('user.create');
	Route::post('user/save/{id?}', 'App\Http\Controllers\UserController@save')->name('user.save');
	Route::get('user/delete/{id}', 'App\Http\Controllers\UserController@delete')->name('user.delete');
	Route::get('user/show/{id}', 'App\Http\Controllers\UserController@show')->name('user.show');

	// Job Notification

	Route::get('notification/create', 'App\Http\Controllers\NotificationController@create')->name('notification.create');
	Route::post('notification/save/{id?}', 'App\Http\Controllers\NotificationController@save')->name('notification.save');
	Route::get('/notifications', 'App\Http\Controllers\NotificationController@index')->name('notifications');
	Route::get('notification/show/{id}', 'App\Http\Controllers\NotificationController@show')->name('notification.show');
	Route::get('notification/delete/{id}', 'App\Http\Controllers\NotificationController@delete')->name('notification.delete');
	Route::get('notification/edit/{id}', 'App\Http\Controllers\NotificationController@edit')->name('notification.edit');
	Route::post('notification/update/{id}', 'App\Http\Controllers\NotificationController@update')->name('notification.update');	
	Route::get('notification/my_index', 'App\Http\Controllers\NotificationController@my_index')->name('notification.my_index');

	//More Links

	Route::get('more_link/create', 'App\Http\Controllers\MoreLinkController@create')->name('more_link.create');
	Route::post('more_link/save/{id?}', 'App\Http\Controllers\MoreLinkController@save')->name('more_link.save');
	Route::get('/more_links', 'App\Http\Controllers\MoreLinkController@index')->name('more_links');
	Route::get('more_link/delete/{id}', 'App\Http\Controllers\MoreLinkController@delete')->name('more_link.delete');
	Route::get('more_link/edit/{id}', 'App\Http\Controllers\MoreLinkController@edit')->name('more_link.edit');
	Route::post('more_link/update/{id}', 'App\Http\Controllers\MoreLinkController@update')->name('more_link.update');
	Route::get('more_link/my_index', 'App\Http\Controllers\MoreLinkController@my_index')->name('more_link.my_index');	

	// VV New Page
	
	Route::get('vv', 'App\Http\Controllers\AuthenticateController@vv')->name('authenticate.vv');
	Route::get('vv/all_in_one', 'App\Http\Controllers\VVController@all_in_one')->name('vv.all_in_one');
	
	
	//VV New Susbscription
	
	Route::get('subscriptions', 'App\Http\Controllers\NewSubscriptionController@index')->name('new_subscriptions');
	Route::get('new_subscription/create', 'App\Http\Controllers\NewSubscriptionController@create')->name('new_subscription.create');
	Route::get('subscription/add', 'App\Http\Controllers\NewSubscriptionController@create_new')->name('new_subscription.create_new');
	Route::get('subscription/renewal', 'App\Http\Controllers\NewSubscriptionController@create_renew')->name('new_subscription.create_renew');
	Route::post('new_subscription/save/{id?}', 'App\Http\Controllers\NewSubscriptionController@save')->name('new_subscription.save');
	Route::get('new_subscription/delete/{id}', 'App\Http\Controllers\NewSubscriptionController@delete')->name('new_subscription.delete');
	Route::get('new_subscription/show/{id}', 'App\Http\Controllers\NewSubscriptionController@show')->name('new_subscription.show');
	Route::get('new_subscription/export', 'App\Http\Controllers\NewSubscriptionController@export')->name('new_subscription.export');
	
	//VV Renewal
	
	Route::get('renewals', 'App\Http\Controllers\RenewalController@index')->name('renewals');
	Route::get('renewal/create', 'App\Http\Controllers\RenewalController@create')->name('renewal.create');
	Route::post('renewal/save/{id?}', 'App\Http\Controllers\RenewalController@save')->name('renewal.save');
	Route::get('renewal/delete/{id}', 'App\Http\Controllers\RenewalController@delete')->name('renewal.delete');
	Route::get('renewal/show/{id}', 'App\Http\Controllers\RenewalController@show')->name('renewal.show');
	Route::get('renewal/export', 'App\Http\Controllers\RenewalController@export')->name('renewal.export');

	//VV Address Change
	
	Route::get('address_changes', 'App\Http\Controllers\AddressChangeController@index')->name('address_changes');
	Route::get('address_change/request', 'App\Http\Controllers\AddressChangeController@create')->name('address_change.create');
	Route::post('address_change/save/{id?}', 'App\Http\Controllers\AddressChangeController@save')->name('address_change.save');
	Route::get('address_change/delete/{id}', 'App\Http\Controllers\AddressChangeController@delete')->name('address_change.delete');
	
	Route::get('address_change/view/{id}', 'App\Http\Controllers\AddressChangeController@view')->name('address_change.view');
	Route::get('address_change/export', 'App\Http\Controllers\AddressChangeController@export')->name('address_change.export');

	//VV Complaint

	Route::get('complaints', 'App\Http\Controllers\ComplaintController@index')->name('complaints');
	Route::get('complaint/raise', 'App\Http\Controllers\ComplaintController@create')->name('complaint.create');
	Route::post('complaint/save/{id?}', 'App\Http\Controllers\ComplaintController@save')->name('complaint.save');
	Route::get('complaint/delete/{id}', 'App\Http\Controllers\ComplaintController@delete')->name('complaint.delete');
	Route::get('complaint/export','App\Http\Controllers\ComplaintController@export')->name('complaint.export');
	Route::get('complaint/view/{id}', 'App\Http\Controllers\ComplaintController@view')->name('complaint.view');
	
	//VV Prayer Points
	
	Route::get('/prayer_points', 'App\Http\Controllers\PrayerPointController@index')->name('prayer_points');
	Route::get('prayer_point/export','App\Http\Controllers\PrayerPointController@export')->name('prayer_point.export');
	Route::get('prayer_point/send', 'App\Http\Controllers\PrayerPointController@create')->name('prayer_point.create');
	Route::post('prayer_point/save/{id?}', 'App\Http\Controllers\PrayerPointController@save')->name('prayer_point.save');
	Route::get('prayer_point/delete/{id}', 'App\Http\Controllers\PrayerPointController@delete')->name('prayer_point.delete');
	Route::get('prayer_point/show/{id}', 'App\Http\Controllers\PrayerPointController@show')->name('prayer_point.show');
	

	// VV Feedback

	Route::get('/feedbacks', 'App\Http\Controllers\FeedbackController@index')->name('feedbacks');
	Route::get('feedback/post','App\Http\Controllers\FeedbackController@create')->name('feedback.create');
	Route::post('feedback/save/{id?}', 'App\Http\Controllers\FeedbackController@save')->name('feedback.save');
	Route::get('feedback/delete/{id}', 'App\Http\Controllers\FeedbackController@delete')->name('feedback.delete');
	Route::get('feedback/export','App\Http\Controllers\FeedbackController@export')->name('feedback.export');

	
	//VV Prayer Point pdf
	
	Route::get('/monthly_prayer_points', 'App\Http\Controllers\VVPrayerPointController@monthly_prayer_points')->name('vv_prayer_point.monthly_prayer_points');
	Route::get('/vv_prayer_points', 'App\Http\Controllers\VVPrayerPointController@index')->name('vv_prayer_points');
	Route::get('vv_prayer_point/upload/{id?}', 'App\Http\Controllers\VVPrayerPointController@create')->name('vv_prayer_point.create');
	Route::post('vv_prayer_point/save/{id?}', 'App\Http\Controllers\VVPrayerPointController@save')->name('vv_prayer_point.save');
	Route::get('vv_prayer_point/delete/{id}', 'App\Http\Controllers\VVPrayerPointController@delete')->name('vv_prayer_point.delete');
	//Route::get('vv_prayer_point/show/{id}', 'App\Http\Controllers\VVPrayerPointController@show')->name('vv_prayer_point.show');
	
	//VV Magazine pdf
	
	Route::get('/monthly_magazines', 'App\Http\Controllers\VVMagazineController@monthly_magazines')->name('vv_magazine.monthly_magazines');
	Route::get('vv_magazines', 'App\Http\Controllers\VVMagazineController@index')->name('vv_magazines');
	Route::get('vv_magazine/upload/{id?}', 'App\Http\Controllers\VVMagazineController@create')->name('vv_magazine.create');
	Route::post('vv_magazine/save/{id?}', 'App\Http\Controllers\VVMagazineController@save')->name('vv_magazine.save');
	Route::get('vv_magazine/delete/{id}', 'App\Http\Controllers\VVMagazineController@delete')->name('vv_magazine.delete');
	Route::get('vv_magazine/show/{id}', 'App\Http\Controllers\VVMagazineController@show')->name('vv_magazine.show');
	
	
	
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