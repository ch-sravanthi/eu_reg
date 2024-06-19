<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Gate;
use DB;
use App\Models\Notification;
use Excel;
use AppHelper;

class NotificationController extends Controller
{
	
	public function index(Request $request)
    {
		$notification = new Notification;
		$paginate = 20;
      
		$query = Notification::query();
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('description', 'like', "%{$request->search}%");	
			});
		}
		$query->where('status','Verified');
					
		$notifications =$query->orderBy('updated_at', 'desc')->paginate($paginate);
		
		return view('notification.index',compact(['notifications'],['notification']));
    }
	public function create($id = null)
    {
		$notification = $id ? Notification::findOrFail($id) : new Notification;
        return view ('notification/create',compact(['notification']));
    }
	public function save(Request $request, $id = null)
    {
        $notification = $id ? Notification::findOrFail($id) : new Notification;
		$validator = Validator::make($request->all(), $notification->rules()); 
		if ($validator->fails()) { //var_dump($validator->messages()); die();
			return Redirect::back()
				->withInput()
				->withErrors($validator);
		}
		$notification->fill($request->all());
		if ($request->file('image_1')) {
			$notification->image_1 = $request->file('image_1')->store('notifications');
		}
		
		$notification->save();
		return redirect()->back()->with('success', 'Notification Details Added Successfully');
    }
	
	public function delete($id)
    {
        $notification = Notification::findOrFail($id);
		$notification->delete();
		return redirect(url('notification/my_index'));
    }
	
	public function show($id)
	{
		$notification = Notification::findOrFail($id);
		return view('notification/show', compact(['notification']));
	}
	
	public function my_show($id)
	{
		$notification = Notification::findOrFail($id);
		return view('notification/my_show', compact(['notification']));
	}
	
	public function edit($id) {
		if(!Auth::user()) {
			return redirect()->back()->with(['error' => 'You do not have access']);
		}
		$notification = Notification::findOrFail($id);
		return view('notification.edit', ['notification' => $notification]);
	}
	
	public function update(Request $request, $id) {
		$notification = Notification::findOrFail($id);		
		$notification->fill($request->all());
		$notification->status = $request->status;
		$notification->description = $request->description;
		//var_dump(Auth::user());die();
		$notification->updated_by = Auth::user()->id;		
		$notification->save();
		return redirect('/notification/my_index');
	}
	public function my_index(Request $request)
    {
		$notification = new Notification;
		$paginate = 20;
      
		$query = notification::query();
		if ($request->search) {
			$query->where(function($q) use($request){
				$q->orwhere('description', 'like', "%{$request->search}%");	
			});
		}
					
		$notifications = $query->orderBy('updated_at', 'desc')->paginate($paginate);
		
		return view('notification/my_index',compact(['notifications'],['notification']));
    }
}


