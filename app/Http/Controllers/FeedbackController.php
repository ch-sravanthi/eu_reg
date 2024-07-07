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
use App\Models\Feedback;
use App\Exports\FeedbackExport;
use Maatwebsite\Excel\Facades\Excel;


class FeedbackController extends Controller
{
	public function index(Request $request)
    {
		$feedback = new Feedback;
		$paginate = 20;
		$query = Feedback::query();
		 $article = $request->article;
		
		$query->when($article,function($a) use($article)		{
			$a->where('article','like',"%$article%");
		});
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$feedbacks = $query->orderBy('created_at', 'desc')->paginate($paginate);	
		return view('feedback.index',compact(['feedbacks','feedback']));  
	}
	
	public function create($id = null) 
	{
		$feedback = $id? Feedback::findOrFail($id):new Feedback;
		return view('feedback/create',compact(['feedback']));	
    }
	
    public function save(Request $request, $id = null)
	{
		$feedback = $id ? Feedback::findOrFail($id) : new Feedback;
		$rules = $feedback->rules();
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {//var_dump($validator->messages()); die();
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}

		$feedback->fill($request->all());
		//echo '<pre>'; print_r($request->all());  echo '</pre>';die();
		// Check if 'rate' and 'article 'is an array before using implode
		
		if(is_array($feedback->rate)){
			$feedback->rate = implode(',', $feedback->rate);
		}else {
			$rate = $request->rate; // or handle it accordingly if it's not an array
		}
		if(is_array($feedback->article)){
			$feedback->article = implode(',', $feedback->article);
		}else {
			$article = $request->article; // or handle it accordingly if it's not an array
		} 
		$feedback->save();
		return redirect()->back()->with('success', 'Feedback Saved Successfully');
	}
	
	public function delete($id)
    { 
        if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}

		$feedback = Feedback::findOrFail($id);
		$feedback->delete();
		return redirect(url('feedbacks'));
    }
	
    public function export(Request $request)
	{
		$feedback = new Feedback;
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$query=Feedback::query();
		$feedback =$query->get();
		return Excel::download(new FeedbackExport($feedback), 'feedback.xlsx');
	}
}
