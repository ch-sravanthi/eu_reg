<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Gate;
use DB;
use App\Models\User;
use Excel;
use AppHelper;

class UserController extends Controller
{
    public function index(Request $request)
    {
		$user =new User;
		$paginate =10;
		$query = User::query();
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('email', 'like', "%{$request->search}%");
				$q->orwhere('mobile', 'like', "%{$request->search}%");
				$q->orwhere('name', 'like', "%{$request->search}%");	
				$q->orwhere('role', 'like', "%{$request->search}%");	
			});
		}
		if(!Auth::user()->role == 'Admin') {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}	
		$users =$query->orderBy('updated_at', 'desc')->paginate($paginate);
		return view('user/index',compact(['users'],['user']));
    }
	
	public function create($id = null)
	{
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$user = $id ? User::findOrFail($id) : new User;
	  return view('user.create',compact(['user']));
    }
	

    /**
     * Show the form for creating a new resource.
     */
	public function save(Request $request, $id=null)
    {
        $user = $id ? User::findOrFail($id) : new User;
	
		$validator = Validator::make($request->all(), $user->rules(), [], $user->nicenames); 
		if ($validator->fails()) {// var_dump($validator->messages()); die();
			
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		$user->fill($request->all());	
		
		$user->name = $request->name;
		$user->email = $request->email;
		$user->mobile = $request->mobile;
		$user->role = $request->role;
		if($request->status){
			$user->status = $request->status;
		}
		if(!$id){
			$user->created_by = Auth::user()->id;
		}else{
			$user->updated_by = Auth::user()->id;		
		}
		if($request->email){		
			$old = User::where('id', '<>', $id)->where('email', $request->email)->latest()->first();
			if($old){
				return redirect()->back()->withInput()->with('error', 'Email Id Already Exists!');
			}
		}
		$user->save();

		return redirect(url('subscribers'))->with('success', 'User Details Added Successfully');
    }
	
	
	public function delete( $id)
    {
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
        $user = User::findOrFail($id);
		$user->delete();
		
		return redirect(url('subscribers'))->with('success', 'User Details Deleted Successfully');
    }
	
	
	public function show( $id)
	{
		$user = User::findOrFail($id);
		return view('user/show', compact('user'));
	}
	
	
	public function subscribers(Request $request)
    {
		$user =new User;
		$paginate =10;
		$query = User::query();
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('email', 'like', "%{$request->search}%");
				$q->orwhere('mobile', 'like', "%{$request->search}%");
				$q->orwhere('name', 'like', "%{$request->search}%");	
				$q->orwhere('role', 'like', "%{$request->search}%");	
			});
		}
		$query->where('role','Subscriber');
		$users =$query->orderBy('updated_at', 'desc')->paginate($paginate);
		return view('user/subscriber_list',compact(['users'],['user']));
    }
	
	
}
