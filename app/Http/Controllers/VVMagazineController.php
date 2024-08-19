<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Gate;
use DB;
use App\Models\VVMagazine;
use AppHelper;
use Excel;


class VVMagazineController extends Controller
{
	public function index(Request $request)
    {
		$vv_magazine = new VVMagazine;
		$paginate = 12;
        
		$name_of_the_file = $request->name_of_the_file;
        $magazine_month = $request->magazine_month;
        $magazine_year = $request->magazine_year;
      
		$query = VVMagazine::query();
		
		$query->when($name_of_the_file,function($a) use($name_of_the_file)	{
			$a->where('name_of_the_file','like',"%$name_of_the_file%");
		});
		$query->when($magazine_month,function($a) use($magazine_month){
			$a->where('magazine_month','like',"%$magazine_month%");
		});
		$query->when($magazine_year,function($a) use($magazine_year){
			$a->where('magazine_year','like',"%$magazine_year%");
		});
		
		if(!Auth::user()->role == 'Admin') {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}	
		$vv_magazines = $query->orderBy('created_at', 'desc')->paginate($paginate);
		
		return view('vv_magazine.index',compact((['vv_magazines','vv_magazine'])));
	}
	
	public function monthly_magazines(Request $request)
    {
		$vv_magazine = new VVMagazine;
		$paginate = 12;
        
		$name_of_the_file = $request->name_of_the_file;
        $magazine_month = $request->magazine_month;
        $magazine_year = $request->magazine_year;
      
		$query = VVMagazine::query();
		
		$query->when($name_of_the_file,function($a) use($name_of_the_file)	{
			$a->where('name_of_the_file','like',"%$name_of_the_file%");
		});
		$query->when($magazine_month,function($a) use($magazine_month){
			$a->where('magazine_month','like',"%$magazine_month%");
		});
		$query->when($magazine_year,function($a) use($magazine_year){
			$a->where('magazine_year','like',"%$magazine_year%");
		});
		
		
		$vv_magazines = $query->orderBy('created_at', 'desc')->paginate($paginate);

		return view('vv_magazine/monthly_magazines',compact((['vv_magazines','vv_magazine'])));
	}
	
	public function create($id = null) 
	{
		if(Auth::user()->role == 'Subscriber') {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		else {
			$vv_magazine = $id ? VVMagazine::findOrFail($id) : new VVMagazine;
			return view ('vv_magazine/create',compact(['vv_magazine']));	
		}		
    }
	
    public function save(Request $request, $id = null)
    {
		$vv_magazine = $id ? VVMagazine::findOrFail($id) : new VVMagazine;
		$rules = $vv_magazine->rules();
		if ($vv_magazine->cover_page != null && !empty($vv_magazine->cover_page) && !$request->file('cover_page')) {
			unset($rules['cover_page']);
		}
		if ($vv_magazine->prayer_copy != null && !empty($vv_magazine->prayer_copy) && !$request->file('prayer_copy')) {
			unset($rules['prayer_copy']);
		}
		if ($vv_magazine->magazine_copy != null && !empty($vv_magazine->magazine_copy) && !$request->file('magazine_copy')) {
			unset($rules['magazine_copy']);
		}
		$validator = Validator::make($request->all(), $rules);
		 
		if ($validator->fails()) {//var_dump($validator->messages()); die();
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		$vv_magazine->fill($request->all());
		if ($request->file('cover_page')) {
			$vv_magazine->cover_page = $request->file('cover_page')->store('blogs');
		}
		if ($request->file('prayer_copy')) {
			$vv_magazine->prayer_copy = $request->file('prayer_copy')->store('vv_magazines');
		}
		if ($request->file('magazine_copy')) {
			$vv_magazine->magazine_copy = $request->file('magazine_copy')->store('vv_magazines');
		}
		
		$vv_magazine->save();
		return redirect(url('vv_magazines'))->with('success', 'Magazine Submitted Successfully');

	}
	
	public function show($id)
	{
		$vv_magazine = VVMagazine::findOrFail($id);
		return view('vv_magazine/show', compact(['vv_magazine']));
	}
	
	public function delete($id)
    { 
        /* if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		} */
		$vv_magazine = VVMagazine::findOrFail($id);
		$vv_magazine->delete();
		return redirect()->back()->with('success', 'Magazine Record Deleted Successfully');
    }
	
   
}