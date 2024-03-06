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
        $titleFilter= $request->blog_title;
        $description= $request->description;
        $category= $request->category;
      
		$query = Blog::query();
		
		$query->when($titleFilter,function($a) use($titleFilter)		{
			$a->where('blog_title','like',"%$titleFilter%");
		});
		$query->when($category,function($a) use($category)		{
			$a->where('category','like',"%$category%");
		});
		
		$query->when($description,function($a) use($description){
			$a->where('description','like',"%$description%");
		
			});		
		$query->where('status','Verified');
		
		$blogs =$query->orderBy('updated_at', 'desc')->paginate($paginate);
		
		return view('welcome',compact((['blogs','blog'])));
    }
	
	
	
}


