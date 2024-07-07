<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RenewalController;
use App\Models\Renewal;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Gate;
use DB;
use App\Models\User;
use Excel;
use App\Exports\RenewalExport;
use AppHelper;

class RenewalController extends Controller
{
    public function index(Request $request)
    {
		$renewal = new Renewal;
		$paginate = 20;
		$query = Renewal::query();
		$district = $request->district;
		
		$query->when($district,function($a) use($district)		{
			$a->where('district','like',"%$district%");
		});
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}	
		$renewals = $query->orderBy('created_at', 'desc')->paginate($paginate);
		return view('renewal/index',compact(['renewals','renewal']));
    }
	public function create($id = null)
	{
		$renewal = $id ? Renewal::findOrFail($id) : new Renewal;
		return view('renewal.create', compact(['renewal']));
	}
	

    /**
     * Show the form for creating a new resource.
     */
	public function save(Request $request, $id=null)
    {
        $renewal = $id ? Renewal::findOrFail($id) : new Renewal;
	
		$rules = $renewal->rules();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) { //var_dump($validator->messages()); die();
			
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		$renewal->fill($request->all());	
		
		$renewal->save();
		return redirect()->back()->with('success', 'Renewal Details Saved Successfully');
    }
	
	
	public function delete($id)
    {
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$renewal = Renewal::findOrFail($id);
		$renewal->delete();
		return redirect(url('renewals'));
    }
	public function show($id)
	{
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$renewal = Renewal::findOrFail($id);
		return view('renewal.show', compact('renewal'));
	}	
	public function export(Request $request)
	{
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$renewal = new Renewal;
		$query = Renewal::query();
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('email', 'like', "%{$request->search}%");
				$q->orwhere('mobile_num', 'like', "%{$request->search}%");
				$q->orwhere('full_name', 'like', "%{$request->search}%");	
				$q->orwhere('type_of_subscription', 'like', "%{$request->search}%");	
			});
		}
		$renewals = $query->get();

		return Excel::download(new \App\Exports\RenewalExport($renewals), 'renewals.xlsx');

	}
}
