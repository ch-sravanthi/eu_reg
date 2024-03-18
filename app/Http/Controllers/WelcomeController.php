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
		
		if ($request->blog_title) $query->where('blog_title', 'like', "%{$request->blog_title}%");
		if ($request->category) $query->where('category', 'like', "%{$request->category}%");
		if ($request->description) $query->where('description', 'like', "%{$request->description}%");	
		$query->where('status','Verified');
		
		$blogs =$query->orderBy('updated_at', 'desc')->paginate($paginate);
		
		return view('welcome',compact((['blogs','blog'])));
    }
	
	
	
}


