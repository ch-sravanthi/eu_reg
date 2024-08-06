<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Gate;
use DB;
use App\Models\VVPrayerPoint;
use AppHelper;
use Excel;


class VVPrayerPointController extends Controller
{
	public function index(Request $request)
    {
		$vv_prayer_point = new VVPrayerPoint;
		$paginate = 12;
       
      
		$name_of_the_file = $request->name_of_the_file;
        $vv_month = $request->vv_month;
        $vv_year = $request->vv_year;
      
	  
		$query = VVPrayerPoint::query();
		
		$query->when($name_of_the_file,function($a) use($name_of_the_file)	{
			$a->where('name_of_the_file','like',"%$name_of_the_file%");
		});
		$query->when($vv_month,function($a) use($vv_month){
			$a->where('vv_month','like',"%$vv_month%");
		});
		$query->when($vv_year,function($a) use($vv_year){
			$a->where('vv_year','like',"%$vv_year%");
		});

		if(!Auth::user()->role == 'Admin') {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		
		$vv_prayer_points = $query->orderBy('created_at', 'desc')->paginate($paginate);
		return view('vv_prayer_point/index',compact((['vv_prayer_points','vv_prayer_point'])));
	}
	
	public function monthly_prayer_points(Request $request)
    {
		$vv_prayer_point = new VVPrayerPoint;
		$paginate = 12;
		$name_of_the_file = $request->name_of_the_file;
        $vv_month = $request->vv_month;
        $vv_year = $request->vv_year;
      
	  
		$query = VVPrayerPoint::query();
		
		$query->when($name_of_the_file,function($a) use($name_of_the_file)	{
			$a->where('name_of_the_file','like',"%$name_of_the_file%");
		});
		$query->when($vv_month,function($a) use($vv_month){
			$a->where('vv_month','like',"%$vv_month%");
		});
		$query->when($vv_year,function($a) use($vv_year){
			$a->where('vv_year','like',"%$vv_year%");
		});
		
		$vv_prayer_points = $query->orderBy('created_at', 'desc')->paginate($paginate);
		return view('vv_prayer_point/monthly_prayer_points',compact((['vv_prayer_points','vv_prayer_point'])));
	}
	
	public function create($id = null) 
	{
		$vv_prayer_point = $id ? VVPrayerPoint::findOrFail($id) : new VVPrayerPoint;
        return view ('vv_prayer_point/create',compact(['vv_prayer_point']));		
    }
	
    public function save(Request $request, $id = null)
    {
		$vv_prayer_point = $id ? VVPrayerPoint::findOrFail($id) : new VVPrayerPoint;
		$rules = $vv_prayer_point->rules();
		if ($vv_prayer_point->attachment_1 != null && !empty($vv_prayer_point->attachment_1) && !$request->file('attachment_1')) {
			unset($rules['attachment_1']);
		}
		$validator = Validator::make($request->all(), $rules);
		 
		if ($validator->fails()) {//var_dump($validator->messages()); die();
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		
		$vv_prayer_point->fill($request->all());
		if ($request->file('attachment_1')) {
			$vv_prayer_point->attachment_1 = $request->file('attachment_1')->store('vv_prayer_points');
		}
		
		$vv_prayer_point->save();
		return redirect()->back()->with('success', 'VV Prayer Points Added Successfully');

	}
	
	public function show($id)
	{
		$vv_prayer_point = VVPrayerPoint::findOrFail($id);
		return view('vv_prayer_point/show', compact(['vv_prayer_point']));
	}
	
	public function delete($id)
    { 
        /* if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		} */
		$vv_prayer_point = VVPrayerPoint::findOrFail($id);
		$vv_prayer_point->delete();
		return redirect()->back()->with('success', 'VV Prayer Point Record Deleted Successfully');
    }
    
	
}