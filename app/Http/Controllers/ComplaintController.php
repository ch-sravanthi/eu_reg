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
use App\Models\Complaint;
use App\Exports\ComplaintExport;
use Maatwebsite\Excel\Facades\Excel;

class ComplaintController extends Controller 
{
	public function index(Request $request)
	{
		$complaint = new Complaint;
		$paginate =10;
        
        $district = $request->district;
		$query = Complaint::query();
		$query->when($district,function($a) use($district)		{
			$a->where('district','like',"%$district%");
		});
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}	
		$complaints = $query->orderBy('created_at', 'desc')->paginate($paginate);
		
		return view('complaint.index',compact((['complaints','complaint'])));
	}
	
	public function create($id = null)
	{
		$complaint = $id ? Complaint::findOrFail($id) : new Complaint;
		return view('complaint.create',compact(['complaint']));
	}
	
	public function save(Request $request, $id = null)
	{
		$complaint = $id ? Complaint::findOrFail($id) : new Complaint;
		$rules = $complaint->rules();
		$validator = Validator::make($request->all(), $rules);
		 
		if ($validator->fails()) { //var_dump($validator->messages()); die();
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		$complaint->fill($request->all());
		$complaint->save();
		return redirect()->back()->with('success', 'Your Complaint Details Added Successfully');
	}
	
	public function view($id)
	{
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$complaint = Complaint::findOrFail($id);
		return view('complaint.view', compact(['complaint']));
	}
	
	public function delete($id)
	{
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$complaint = Complaint::findOrFail($id);
		$complaint->delete();
		return redirect()->back()->with('warning', 'Deleted Successfully');
	}
		
	public function export(Request $request){

		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$complaint = new Complaint;
		$query = $complaint->getQuery($request->all());
		$complaint->Query($query);
		$complaint = $query->get();
		return Excel::download(new ComplaintExport($complaint), 'complaint.xlsx');
	} 
}
