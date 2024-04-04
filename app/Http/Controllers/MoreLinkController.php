<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Gate;
use DB;
use App\Models\MoreLink;
use Excel;
use AppHelper;

class MoreLinkController extends Controller
{
	
	public function index(Request $request)
    {
		$more_link = new MoreLink;
		$paginate = 20;
      
		$query = MoreLink::query();
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('link_url', 'like', "%{$request->search}%");	
			});
		}
		$query->where('status','active');
					
		$more_links = $query->orderBy('updated_at', 'desc')->paginate($paginate);
		
		return view('more_link/index',compact(['more_links'],['more_link']));
    }
	public function create($id = null)
    {
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$more_link = $id ? MoreLink::findOrFail($id) : new MoreLink;
        return view ('more_link/create',compact(['more_link']));
    }
	public function save(Request $request, $id = null)
    {
        $more_link = $id ? MoreLink::findOrFail($id) : new MoreLink;
		$validator = Validator::make($request->all(), $more_link->rules()); 
		if ($validator->fails()) { //var_dump($validator->messages()); die();
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		$more_link->fill($request->all());
		
		$more_link->save();
		return redirect()->back()->with('success', 'Links Added Successfully');
    }
	
	public function delete($id)
    {
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
        $more_link = MoreLink::findOrFail($id);
		$more_link->delete();
		return redirect(url('more_link/my_index'));
    }
	
	public function edit($id) {
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$more_link = MoreLink::findOrFail($id);
		return view('more_link.edit', ['more_link' => $more_link]);
	}
	
	public function update(Request $request, $id) {
		$more_link = MoreLink::findOrFail($id);		
		$more_link->fill($request->all());
		
		$more_link->link_url = $request->link_url;
		//var_dump(Auth::user());die();
		$more_link->updated_by = Auth::user()->id;		
		$more_link->save();
		return redirect('/more_link/my_index');
	}
	public function my_index(Request $request)
    {
		$more_link = new MoreLink;
		$paginate = 20;
      
		$query = MoreLink::query();
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('link_url', 'like', "%{$request->search}%");	
			});
		}
		$query->where('status','active');
					
		$more_links = $query->orderBy('updated_at', 'desc')->paginate($paginate);
		
		return view('more_link/my_index',compact(['more_links'],['more_link']));
    }
	
}


