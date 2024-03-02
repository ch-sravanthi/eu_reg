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

Route::get('/', function () {
    return view('welcome');	
});
	
//Auth::routes();
	Route::group(['middleware'], function () {	
	Route::get('/main_menu', ['as' => 'field_staff_report.main_menu', 'uses' => 'ProjectPartnerBillController@mainMenu']);
	Route::get('/bills_sub_menu', ['as' => 'field_staff_report.sub_menu', 'uses' => 'ProjectPartnerBillController@subMenu']);
	Route::get('/donation/select', ['as' => 'donation.select', 'uses' => 'DonationController@select']);
	Route::get('/donation/create/{type}', ['as' => 'donation.create', 'uses' => 'DonationController@create']);
	Route::post('/donation/save/{type}', ['as' => 'donation.save', 'uses' => 'DonationController@save']);
	Route::get('/donation/un', ['as' => 'donation.un', 'uses' => 'DonationController@un']);
	Route::get('/donation/home', ['as' => 'donation.home', 'uses' => 'DonationController@home']);
	Route::get('/donation_ft_sub_menu/{model_name}', ['as' => 'field_staff_report.donation_ft_sub_menu', 'uses' => 'DonationController@donationFTSubMenu']);
	Route::get('/donation_multi_sub_menu/{donation_name}', ['as' => 'field_staff_report.donation_multi_sub_menu', 'uses' => 'TransactionController@donationMultiMenu']);
	Route::get('/project_partner_bill/create/{model_name}', ['as' => 'project_partner_bill.create', 'uses' => 'ProjectPartnerBillController@create']);
	Route::get('/project_partner_bill/create_new/{model_name}', ['as' => 'project_partner_bill.create_new', 'uses' => 'ProjectPartnerBillController@create_new']);
	Route::post('/project_partner_bill/save/{model_name}', ['as' => 'project_partner_bill.save', 'uses' => 'ProjectPartnerBillController@save']);
	//Route::post('/project_partner_bill/sendAcknowledgment/{id}', ['as' => 'project_partner_bill.sendAcknowledgment', 'uses' => 'ProjectPartnerBillController@sendAcknowledgment']);	
	Route::get('/cashdonation/create', ['as' => 'cashdonation.create', 'uses' => 'CashDonationController@create']);
	Route::get('/transaction/create/{transaction_model}/{donation_name}',['as' => 'transaction.create', 'uses' =>'TransactionController@create']);	
	Route::post('/transaction/save/{transaction_model}/{donation_name}/{title}', ['as' => 'transaction.save', 'uses' => 'TransactionController@save']);
	Route::post('/cashdonation/save', ['as' => 'cashdonation.save', 'uses' => 'CashDonationController@save']);
	Route::get('/ministry_donation/create/{model_name}', ['as' => 'ministry_donation.create', 'uses' => 'MinistryDonationController@create']);
	Route::post('/ministry_donation/save/{model_name}', ['as' => 'ministry_donation.save', 'uses' => 'MinistryDonationController@save']);
	
	Route::get('/signup/{id}', ['as' => 'signup', 'uses' => 'AuthController@signup']);
	Route::post('/signup/validate/{id}', ['as' => 'signup.validate', 'uses' => 'AuthController@validateSignup']);
	Route::get('/signup/otp/{type}', ['as' => 'signup.otp', 'uses' => 'AuthController@signupOtp']);
	Route::post('/signup/verify_otp/{type}', ['as' => 'signup.verify_otp', 'uses' => 'AuthController@signupVerifyOtp']);
	Route::get('/signout', ['as' => 'signout', 'uses' => 'AuthController@signout']);
	
	Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@loginPage']);
	Route::post('/login', ['as' => 'login', 'uses' => 'AuthController@login']);	
	Route::get('/login/otp', ['as' => 'login.otp', 'uses' => 'AuthController@loginOtp']);
	Route::post('/login/verify_otp', ['as' => 'login.verify_otp', 'uses' => 'AuthController@loginVerifyOtp']);
	
	
	Route::group(['middleware' => 'checkUser'], function () {
		Route::get('/home', ['as' => 'home', 'uses' => 'AuthController@home']);
		
		
		Route::get('/organization/create', ['as' => 'organization.create', 'uses' => 'OrganizationController@create']);
		Route::post('/organization/save/{id?}', ['as' => 'organization.save', 'uses' => 'OrganizationController@save']);
		Route::get('/organization/view', ['as' => 'organization.view', 'uses' => 'OrganizationController@view']);		
			
		Route::get('/project/create/{model_name}/{model_id?}', ['as' => 'project.create', 'uses' => 'ProjectController@create']);
		Route::get('/project/select', ['as' => 'project.select', 'uses' => 'ProjectController@select']);
		Route::post('/project/save/{model_name}/{model_id?}', ['as' => 'project.save', 'uses' => 'ProjectController@save']);
		 Route::get('/project/view/{model_name}/{model_id}', ['as' => 'project.view', 'uses' => 'ProjectController@view']);
		 Route::get('/project/edit/{model_name}/{model_id}', ['as' => 'project.edit', 'uses' => 'ProjectController@edit']);
		 Route::post('/project/update/{model_name}/{model_id}', ['as' => 'project.update', 'uses' => 'ProjectController@update']);
		 
		Route::get('/project/check/{project_name}/{project_id}/{type}', ['as' => 'project.check', 'uses' => 'ProjectController@check']);
		Route::get('/incharge/create/{project_name}/{project_id}/{type}/{id?}', ['as' => 'incharge.create', 'uses' => 'InchargeController@create']);
		Route::post('/incharge/save/{project_name}/{project_id}/{type}/{id?}', ['as' => 'incharge.save', 'uses' => 'InchargeController@save']);
		
		Route::get('/incharge/listview/{project_name}/{project_id}/{type}', ['as' => 'incharge.listview', 'uses' => 'InchargeController@listview']);
		//Route::post('/center_incharge/save/{project_name}/{project_id}/{replacement_id?}', ['as' => 'center_incharge.save', 'uses' => 'CenterInchargeController@save']);	
		
		Route::get('/incharge/view/{model_name}/{model_id}/{type}/{id?}', ['as' => 'incharge.view', 'uses' => 'InchargeController@view']);
		Route::get('/project/create_ten_day_report/{model_name}/{model_id}/{id?}', ['as' => 'project.create_ten_day_report', 'uses' => 'ProjectController@createTenDayReport']);
		Route::post('/project/save_ten_day_report/{model_name}/{model_id}/{id?}', ['as' => 'project.save_ten_day_report', 'uses' => 'ProjectController@saveTenDayReport']);
		
		Route::get('/project/view_ten_day_report/{model_name}/{model_id}/{id?}', ['as' => 'project.view_ten_day_report', 'uses' => 'ProjectController@viewTenDayReport']);
		
		 Route::get('/project/submit/{model_name}/{model_id}', ['as' => 'project.submit', 'uses' => 'ProjectController@submit']);
		 Route::post('/project/submit_save/{model_name}/{model_id}', ['as' => 'project.submit_save', 'uses' => 'ProjectController@submitSave']);
	});
	
	
	
});

	// File Download
    Route::get('/download/{folder}/{filename}/{name?}', function ($folder, $filename, $name=null) 
    {
       //$file =  Storage::get("$folder/$filename");
       $filepath =  Storage::path("$folder/$filename");
	   $exp = explode('.', $filepath);
	   $fname = ($name) ? $name.'.'.$exp[1] : 'file.'.$exp[1]; 
     //  return response($file, 200)->header('Content-Type', 'image/jpeg');	   
       return response()->download($filepath, $fname);
    })->name('download');