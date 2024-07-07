<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Gate;
use DB;
use AppHelper;
use App\Models\AddressChange;
use App\Exports\AddressChangeExport;
use Maatwebsite\Excel\Facades\Excel;

class AddressChangeController extends Controller
{
	public function index(Request $request)
	{
		
		$address_change = new AddressChange;
		$paginate =10;
        
        $full_name = $request->full_name;
		$query = AddressChange::query();
		$query->when($full_name,function($a) use($full_name)		{
			$a->where('full_name','like',"%$full_name%");
		});
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$address_changes = $query->orderBy('created_at', 'desc')->paginate($paginate);
		
		return view('address_change.index',compact((['address_changes','address_change'])));
	}
	
	
	
	public function create($id = null)
	{
		$address_change = $id ? AddressChange::findOrFail($id) : new AddressChange;
		return view('address_change.create',compact(['address_change']));
	}
	
	public function save(Request $request, $id = null)
	{
		$address_change = $id ? AddressChange::findOrFail($id) : new AddressChange;
		$rules = $address_change->rules();
		$validator = Validator::make($request->all(), $rules); 
	
		if ($validator->fails()) {
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		
		$address_change->fill($request->all());
		
		$address_change->save();
		
		return redirect()->back()->with('success', 'Address Changes Saved Successfully');
	}
	
	public function view($id)
	{
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$address_change = AddressChange::findOrFail($id);
		return view('address_change/view', compact(['address_change']));
	}
	
	public function delete($id)
    { 
        if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$address_change = AddressChange::findOrFail($id);
		$address_change->delete();
		return redirect(url('address_changes'));
    }
		
 	public function export(Request $request){

		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$address_change = new AddressChange;
		$query = $address_change->getQuery($request->all());
		$address_change->Query($query);
		$address_change = $query->get();
		return Excel::download(new AddressChangeExport($address_change), 'address_change.xlsx');
	} 
}
