<?php

namespace App\Http\Controllers;

use App\Http\Controllers\NewSubscriptionController;
use App\Models\NewSubscription;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Gate;
use DB;
use App\Models\User;
use Excel;
use App\Exports\NewSubscriptionExport;
use AppHelper;

class NewSubscriptionController extends Controller
{
    public function index(Request $request)
    {
		$new_subscription = new NewSubscription;
		$paginate = 20;
		$query = NewSubscription::query();
		$district = $request->district;
		
		$query->when($district,function($a) use($district)		{
			$a->where('district','like',"%$district%");
		});
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}	
		$new_subscriptions =$query->orderBy('created_at', 'desc')->paginate($paginate);
		return view('new_subscription/index',compact(['new_subscriptions','new_subscription']));
    }
	
	public function create($id = null)
	{
		$new_subscription = $id ? NewSubscription::findOrFail($id) : new NewSubscription;
		return view('new_subscription.create', compact(['new_subscription']));
	}
	
	public function create_new($id = null)
	{
		$new_subscription = $id ? NewSubscription::findOrFail($id) : new NewSubscription;
		return view('new_subscription.create_new', compact(['new_subscription']));
	}
	
	public function create_renew($id = null)
	{
		$new_subscription = $id ? NewSubscription::findOrFail($id) : new NewSubscription;
		return view('new_subscription.create_renew', compact(['new_subscription']));
	}
    /**
     * Show the form for creating a new resource.
     */
	public function save(Request $request, $id=null)
    {
        $new_subscription = $id ? NewSubscription::findOrFail($id) : new NewSubscription;
		$rules = $new_subscription->rules();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) { //var_dump($validator->messages()); die();
			
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		$new_subscription->fill($request->all());	
		
		$new_subscription->save();
		return redirect()->back()->with('success', 'New subscription Details Saved Successfully');
    }
	
	
	public function delete($id)
    {
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$new_subscription = NewSubscription::findOrFail($id);
		$new_subscription->delete();
		return redirect(url('subscriptions'));
    }
	 public function show($id)
	{
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$new_subscription = NewSubscription::findOrFail($id);
		return view('new_subscription/show', compact('new_subscription'));
	}
		
	public function export(Request $request)
	{
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$new_subscription = new NewSubscription;
		$query = NewSubscription::query();
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('email', 'like', "%{$request->search}%");
				$q->orwhere('mobile_num', 'like', "%{$request->search}%");
				$q->orwhere('full_name', 'like', "%{$request->search}%");	
				$q->orwhere('new_subscription', 'like', "%{$request->search}%");	
			});
		}
		$new_subscriptions =$query->get();

		return Excel::download(new \App\Exports\NewSubscriptionExport($new_subscriptions), 'new_subscriptions.xlsx');

	}
	
}
