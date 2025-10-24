<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Gate;
use DB;
use App\Models\Conference;
use Excel;
use AppHelper;

class ConferenceController extends Controller
{
	
	public function registration(Request $request)
    { 
		$conference = new Conference;
		$paginate = 10;
      
		$query = Conference::query();
		
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('conference_title', 'like', "%{$request->search}%");
				$q->orwhere('category', 'like', "%{$request->search}%");
				$q->orwhere('description', 'like', "%{$request->search}%");	
				$q->orwhere('location', 'like', "%{$request->search}%");	
			});
		}
		$query->where('status','Verified');
		
		$conferences =$query->orderBy('updated_at', 'desc')->paginate($paginate);
		
		return view('conference/registration',compact((['conferences','conference'])));
    }
	
	public function myindex(Request $request)
    {
		$conference = new Conference;
		$paginate =10;
      
		$query = Conference::query();
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('blog_title', 'like', "%{$request->search}%");
				$q->orwhere('category', 'like', "%{$request->search}%");
				$q->orwhere('description', 'like', "%{$request->search}%");	
				$q->orwhere('location', 'like', "%{$request->search}%");	
			});
		}
					
		$blogs =$query->orderBy('updated_at', 'desc')->paginate($paginate);
		
		return view('conference/my_index',compact(['conferences'],['conference']));
    }
	
	public function add($id = null)
    {
		$conference = $id ? Conference::findOrFail($id) : new Conference;
        return view ('conference/add',compact(['conference']));
    }
	
	public function save(Request $request, $id = null)
    {
        $conference = $id ? Conference::findOrFail($id) : new Conference;
		$validator = Validator::make($request->all(), $conference->rules()); 
		if ($validator->fails()) { //var_dump($validator->messages()); die();
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		$conference->fill($request->all());
		if ($request->file('image_1')) {
			$conference->image_1 = $request->file('image_1')->store('blogs');
		}
		if ($request->file('image_2')) {
			$conference->image_2 = $request->file('image_2')->store('blogs');
		}
		
		$conference->save();
		return redirect()->back()->with('success', 'Job Details Added Successfully');
    }
	
	public function delete( $id)
    {
        $conference = Conference::findOrFail($id);
		$conference->delete();
		return redirect(url('jobportal/my_index'));
    }
	
	public function show( $id)
	{
		$conference = Conference::findOrFail($id);
		return view('conference/show', compact(['conference']));
	}
	
	public function my_show( $id)
	{
		$conference = Conference::findOrFail($id);
		return view('conference/my_show', compact(['blog']));
	}
	
	public function edit($id) {
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$conference = Conference::findOrFail($id);
		return view('conference.edit', ['conference' => $conference]);
	}
	
	public function update(Request $request, $id) {
		$conference = Conference::findOrFail($id);		
					
		$conference->fill($request->all());
		$conference->status = $request->status;
		$conference->category = $request->category;
		$conference->description = $request->description;
		$conference->location = $request->location;
		//var_dump(Auth::user());die();
		$conference->updated_by = Auth::user()->id;		
		
		$conference->save();
		return redirect('/registration/my_index');
	}
}


