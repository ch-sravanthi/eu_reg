<?php

namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;

class VVPrayerPoint extends AppModel
{
    protected $table = "vv_prayer_points";
	protected $fillable=[
		
		'name_of_the_file',
		'attachment_1',
		'vv_month',
		'vv_year',
	];
	
	
	public function rules()
	{
		
		return[
			'name_of_the_file' => 'nullable',
			'attachment_1'	=>	'required|mimes:pdf|max:1024',
			'vv_month' =>	'required',
			'vv_year' => 'required',
		];
	}
	
	public $nicenames =  [
		
		 'name_of_the_file' => 'Name of Prayer Points File',
		 'attachment_1' => 'Prayer Points Attachment',
		 'vv_month' => 'Month',
		 'vv_year' => 'Year',
	];
	public function niceNames()
	{
		return[
			'name_of_the_file' => 'Name of Prayer Points File',
			'attachment_1' => 'Prayer Points Attachment',
			'vv_month' => 'Month',
			'vv_year' => 'Year',
		];
	}
	
}
