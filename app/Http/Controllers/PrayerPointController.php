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
use App\Models\PrayerPoint;
use App\Exports\PrayerPointExport;
use Maatwebsite\Excel\Facades\Excel;


class PrayerPointController extends Controller
{
	public function index(Request $request)
    {
		$prayer_point = new PrayerPoint;
		$paginate =10;
        $euFilter = $request->eu_name;
        $region = $request->region;
        $district = $request->district;
      
		$query = PrayerPoint::query();
		
		$query->when($euFilter,function($a) use($euFilter)		{
			$a->where('eu_name','like',"%$euFilter%");
		});
		$query->when($region,function($a) use($region)		{
			$a->where('region','like',"%$region%");
		});
		
		$query->when($district,function($a) use($district)		{
			$a->where('district','like',"%$district%");
		});
		
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}		
		$prayer_points = $query->orderBy('created_at', 'desc')->paginate($paginate);
		
		return view('prayer_point.index',compact((['prayer_points','prayer_point'])));
	}
	
	public function create($id = null) 
	{
		$prayer_point = $id ? PrayerPoint::findOrFail($id) : new PrayerPoint;
        return view ('prayer_point/create',compact(['prayer_point']));		
    }
	
    public function save(Request $request, $id = null)
    {
		$prayer_point = $id ? PrayerPoint::findOrFail($id) : new PrayerPoint;
		$rules = $prayer_point->rules();
		$validator = Validator::make($request->all(), $rules);
		 
		if ($validator->fails()) { //var_dump($validator->messages()); die();
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		$prayer_point->fill($request->all());
		$prayer_point->save();
		return redirect()->back()->with('success', 'Your Prayer Points Submitted Successfully');

	}
	
	public function show( $id)
	{
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$prayer_point = PrayerPoint::findOrFail($id);
		return view('prayer_point/show', compact(['prayer_point']));
	}
	
	public function delete($id)
    { 
        if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$prayer_point = PrayerPoint::findOrFail($id);
		$prayer_point->delete();
		return redirect(url('prayer_points')->with('success', 'Prayer Point Record Deleted Successfully'));
    }
	
    public function export(Request $request)
	{
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$prayer_point = new PrayerPoint;
		$query=PrayerPoint::query();
		$prayer_point = $query->get();
		return Excel::download(new PrayerPointExport($prayer_point), 'prayer_point.xlsx');
	}
	
}