<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Gate;
use DB;
use App\Models\Blog;
use Excel;
use AppHelper;

class WelcomeController extends Controller
{
	
	
	public function index(Request $request)
    { 
		$blog =new Blog;
		$paginate = 10;
      
		$query = Blog::query();
		
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('blog_title', 'like', "%{$request->search}%");
				$q->orwhere('category', 'like', "%{$request->search}%");
				$q->orwhere('description', 'like', "%{$request->search}%");	
			});
		}
		$query->where('status','Verified');
		
		$blogs =$query->orderBy('updated_at', 'desc')->paginate($paginate);
		
		return view('welcome',compact((['blogs','blog'])));
    }
	
	
	
}


