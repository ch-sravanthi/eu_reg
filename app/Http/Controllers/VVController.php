<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Auth;
use Gate;
use DB;
use Excel;
use AppHelper;

class VVController extends Controller
{
	
	public function all_in_one()
    {
        return view('vv.all_in_one');
    }
	
}


