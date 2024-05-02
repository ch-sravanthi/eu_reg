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

class BlogController extends Controller
{
	
	public function myindex(Request $request)
    {
		$blog =new Blog;
		$paginate =30;
      
		$query = Blog::query();
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('blog_title', 'like', "%{$request->search}%");
				$q->orwhere('category', 'like', "%{$request->search}%");
				$q->orwhere('description', 'like', "%{$request->search}%");	
				$q->orwhere('location', 'like', "%{$request->search}%");	
			});
		}
					
		$blogs =$query->orderBy('updated_at', 'desc')->paginate($paginate);
		
		return view('blog/my_index',compact(['blogs'],['blog']));
    }
	public function create($id = null)
    {
		$blog = $id ? Blog::findOrFail($id) : new Blog;
        return view ('blog/create',compact(['blog']));
    }
	public function save(Request $request, $id = null)
    {
        $blog = $id ? Blog::findOrFail($id) : new Blog;
		$validator = Validator::make($request->all(), $blog->rules()); 
		if ($validator->fails()) { //var_dump($validator->messages()); die();
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		$blog->fill($request->all());
		if ($request->file('image_1')) {
			$blog->image_1 = $request->file('image_1')->store('blogs');
		}
		if ($request->file('image_2')) {
			$blog->image_2 = $request->file('image_2')->store('blogs');
		}
		
		$blog->save();
		return redirect()->back()->with('success', 'Job Details Added Successfully');
    }
	
	public function delete( $id)
    {
        $blog = Blog::findOrFail($id);
		$blog->delete();
		return redirect(url('blog/my_index'));
    }
	
	public function show( $id)
	{
		$blog = Blog::findOrFail($id);
		return view('blog/show', compact(['blog']));
	}
	
	public function my_show( $id)
	{
		$blog = Blog::findOrFail($id);
		return view('blog/my_show', compact(['blog']));
	}
	
	public function edit($id) {
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$blog = Blog::findOrFail($id);
		return view('blog.edit', ['blog' => $blog]);
	}
	
	public function update(Request $request, $id) {
		$blog = Blog::findOrFail($id);		
					
		$blog->fill($request->all());
		$blog->status = $request->status;
		$blog->category = $request->category;
		$blog->description = $request->description;
		$blog->location = $request->location;
		//var_dump(Auth::user());die();
		$blog->updated_by = Auth::user()->id;		
		
		$blog->save();
		return redirect('/blog/my_index');
	}
}


