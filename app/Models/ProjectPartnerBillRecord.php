<?php

namespace App\Models;

use App\AppModel;
//use Auth;
use App\Helpers\AppHelper;

class ProjectPartnerBillRecord extends AppModel
{
	public $fillable = [   
		'term',
		'category',
		'amount',
		//'attachment',
		
	];
	
	public function rules()
	{
		

        return[		
			
			'term' => 'required',
			'amount' => 'required',
			//'attachment' => 'required|mimes:pdf,jpeg,jpg,png|max:2000',
			
        ];
	}
	
	
	public function niceNames()
	{   
        return [	
			'term',
			'category',
			'amount',
			'attachment',
		];
	}

	
	
}

?>

