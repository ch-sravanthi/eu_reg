<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use DB;
use App\Models\UserReferral;
use App\User;
use App\Models\Organization;
use App\Helpers\ApiHelper;
use AppHelper;
use Cache;
use App\Mail\SendMail;

class AuthController extends Controller
{
	public function home(Request $request)
	{	
		$user = User::auth();
		$orgObj = ApiHelper::get('organization');
		if (!empty((array)$orgObj)) {
			$organization = new Organization;
			$organization->fill($orgObj);
		} else {
			$organization = null;
		}
		$projects = ApiHelper::get('projects');	
		$user->organization = $organization;
		session(['user' => $user]);
		
		//echo '<pre>'; print_r($organization); echo '</pre>'; die();	
		return view('home', compact(['user', 'organization', 'projects']));
	}
	
	public function signup($uid)
    {
		//var_dump($uid);die();
		//$user_refferral = UserReferral::where('uid', $uid)->firstOrFail();
		$user_refferral = ApiHelper::getModel('user_referral', 'uid', $uid);
		
		return view('signup', compact(['user_refferral']));

    }


    public function validateSignup(Request $request, $type)
    {
      $user = new User;
		$userEmail = ApiHelper::getModel('user', 'email', $request->email);
		$userMobile = ApiHelper::getModel('user', 'mobile', $request->mobile);
		//var_dump($userEmail);die();
		if ($userEmail) {
			 return Redirect::back()->withInput()->with('error', 'Email already exists');
		}
		if ($userMobile) {
			 return Redirect::back()->withInput()->with('error', 'Mobile already exists');
		}
      $user->fill($request->all());
      session(['user' => $user->getAttributes()]);
      return redirect(route('signup.otp', 'email'));

    }

	public function signupOtp(Request $request, $type)
	{
		$user = new User;    
		$user->fill(session('user'));
		session(['otp' => null]);
		if (!session('otp')) {
			if ($type == 'email') {
				AppHelper::otpEmail($user->email);
			} elseif ($type == 'mobile') {
				AppHelper::otpMobile($user->mobile);
			}
		}
		return view('signup_otp', compact(['user', 'type']));

	}

	public function signupVerifyOtp(Request $request, $type)
	{
		$user = new User;
		$user->fill(session('user'));
		
		if ($type == 'mobile' && $request->otp != session('otp')) {
			return redirect()->back()->withInput()->with('error', 'Invalid OTP');			
		}
		session(['otp' => null]);
		
		if ($type == 'email') {
		  return redirect(route('signup.otp', 'mobile'));
		} 
		if ($type == 'mobile') {
		 //	echo '<pre>'; print_r($user->getAttributes()); echo '</pre>'; die();
		  $user = ApiHelper::get('signup', $user->getAttributes());
		 
		  session(['user' => $user]);
		  return redirect(route('home'));

		}
		return view('signup_otp', compact(['user', 'type']));

	}
  
	public function loginPage() {
		return view('login');
	}
	
	
	public function login(Request $request) { 
		$request->validate([
			'email' => 'required|string',
		]);
		
		$user = ApiHelper::getModel('user', 'email', $request->email);
		//echo '<pre>'; print_r($user); echo '</pre>'; die();
		
		session(['loginuser' => $user]);
		if ($user) {
			AppHelper::otpMobile($user->mobile, true, $user->email);
			return redirect(route('login.otp'));
		}

		return redirect()->back()->withInput()->withErrors(['email' => 'Invalid Email/ID']);
		//return redirect()->back()->withInput()->with('error', 'Invalid Email or Password');
	}
	
	public function loginOtp(Request $request)
	{ 
		$user = session('loginuser');
		if ($request->resend) {			
			AppHelper::otpMobile($user->mobile, true, $user->email);
			return redirect(route('login.otp')); //reload
		}
		//echo '<pre>'; print_r($user); echo '</pre>'; die();
		return view('login_otp', compact(['user']));

	}
	
	public function loginVerifyOtp(Request $request)
	{ 
		$user = session('loginuser');
		if ($request->otp != session('otp')) {
			return redirect()->back()->withInput()->with('error', 'Invalid OTP');			
		}
		session(['otp' => null]);

		$authUser = ApiHelper::get('login_otp', ['email' => $user->email]);
		//echo '<pre>'; print_r($authUser); echo '</pre>'; die();
		session(['loginuser' => null]);
		session(['user' => $authUser]);
		//return view('login_otp', compact(['user']));
		return redirect(route('home'));

	}
	
	public function signout() {
		session(['user' => null]);
		return redirect(route('login'));
	}
  

}
