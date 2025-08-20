<?php
 
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use App\Helpers\ApiHelper;
//use Illuminate\Auth\AuthenticationException;
use AppHelper;
use Auth;
 
class AuthenticateController extends Controller
{
    public function login()
    {
        return view('authenticate.login');
    }
 
	public function vv_login()
    {
        return view('authenticate.vv_login');
    }
 
	public function vv()
    {
        return view('authenticate.vv');
    }
	
	public function otp()
    {
		
        return view('authenticate.otp');
    }
	
    public function authenticate(Request $request)
    {
		 $request->validate([
				'email' => 'required|string',
			]); 
		$credentials = [
			'email' => $request->email,
		];
		$user = User::where('email', $request->email)->first();
		 //echo '<pre>'; print_r($user); echo '</pre>'; die();
		
		/* session(['loginuser' => $user]);
		if ($user) { 
			AppHelper::otpMobile($user->mobile, true, $user->email_id);
			return redirect(route('login.otp', $user->id));
		} */
		
		if (!$user) { 
			return redirect()->back()->withInput()->withErrors(['email' => 'Email is incorrect']);
		}
		Auth::login($user);
		if(Auth::user()->role == 'Admin') {
			return redirect(url('jobportal/my_index'));
		}else{
			return redirect()->back()->withInput()->withErrors(['email' => 'Email is incorrect']);
		}
		
	}
	
	public function vv_all(Request $request)
    {
		 $request->validate([
				'email' => 'required|string',
			]); 
		$credentials = [
			'email' => $request->email,
		];
		$user = User::where('email', $request->email)->first();
		 //echo '<pre>'; print_r($user); echo '</pre>'; die();
		
		if (!$user) { 
			return redirect()->back()->withInput()->withErrors(['email' => 'Email is incorrect']);
		}
		Auth::login($user);
		if(Auth::user()->role == 'Admin') {
			return redirect(url('vv/all_in_one'));
		}elseif(Auth::user()->role == 'Subscriber'){
			return redirect(url('monthly_magazines'));
			
		}
	}
		
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('authenticate.vv_login'));
 
    }
	
	
	public function loginOtp(Request $request, $user_id)
	{ 		
		 $user = User::findOrFail($user_id);		
		if ($request->resend) {	
			AppHelper::otpMobile($user->mobile, true, $user->email);
			return redirect(route('login.otp', $user->id))->with('success', 'OTP Resent successfully');
		}
		//echo '<pre>'; print_r($user); echo '</pre>'; die();
		return view('authenticate.login_otp', compact(['user']));

	}
	
	public function loginVerifyOtp(Request $request, $user_id)
	{ 
		$user = User::findOrFail($user_id); 
		var_dump($request->otp); 
		var_dump(session('otp'));die();
		if ($request->otp != session('otp')) {
			return redirect()->back()->withInput()->with('error', 'Invalid OTP');			
		}
		session(['otp' => null]);
		Auth::login($user);
		return redirect(url('blog/my_index'));
			

	}
	public function egf_home()
    {
        return view('authenticate.egf_home');
    }
	
 
}