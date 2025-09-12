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
use App\Models\EgfBasicInfo;
use App\Exports\EgfBasicInfoExport;
use Maatwebsite\Excel\Facades\Excel;


class EgfBasicInfoController extends Controller
{
	public function index(Request $request)
    {
		$egf_basic_info = new EgfBasicInfo;
		$paginate = 5;
		$query = EgfBasicInfo::query();
		 $article = $request->article;
		
		$query->when($article,function($a) use($article)		{
			$a->where('article','like',"%$article%");
		});
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$egf_basic_infos = $query->orderBy('created_at', 'desc')->paginate($paginate);	
		return view('egf_basic_info.index',compact(['egf_basic_infos','egf_basic_info']));  
	}
	
	public function create($id = null) 
	{ 
		$egf_basic_info = $id? EgfBasicInfo::findOrFail($id):new EgfBasicInfo;
		return view('egf_basic_info/create',compact(['egf_basic_info']));	
    }
	
    public function save(Request $request, $id = null)
	{
		$egf_basic_info = $id ? EgfBasicInfo::findOrFail($id) : new EgfBasicInfo;
		$rules = $egf_basic_info->rules();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {//var_dump($validator->messages()); die();
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}

		$egf_basic_info->fill($request->all());
		//echo '<pre>'; print_r($request->all());  echo '</pre>';die();
		if(!$id){
			$egf_basic_info->created_by = Auth::user()->id;
		}else{
			$egf_basic_info->updated_by = Auth::user()->id;		
		}
		$egf_basic_info->save(); 
		 
		return redirect()->route('egf_basic_info.view', ['id' => $egf_basic_info->id])
                     ->with('success', 'EGF Basic Information Saved successfully');

	}
	public function view($id)
	{ 
		$egf_basic_info = EgfBasicInfo::findOrFail($id);
		return view('egf_basic_info/view', compact(['egf_basic_info']));
	}
	
	public function delete($id)
    { 
        if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$egf_basic_info = EgfBasicInfo::findOrFail($id);
		$egf_basic_info->delete();
		return redirect(url('egf_basic_infos'));
    }
	
    public function export(Request $request)
	{
		$egf_basic_info = new EgfBasicInfo;
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$query=egf_basic_info::query();
		$egf_basic_info =$query->get();
		return Excel::download(new egf_basic_infoExport($egf_basic_info), 'egf_basic_info.xlsx');
	}
}
