<?php
namespace App\Models;

use App\AppModel;
//use Auth;
use App\Helpers\AppHelper;

class MinistryDonationAttachment extends AppModel
{
	public $fillable = [   
		'attachment',
		
	];
	
	public function rules()
	{
		

        return[		
			
			'attachment' => 'required|mimes:pdf,jpeg,jpg,png|max:2000',
			
        ];
	}
	
	
	public function niceNames()
	{   
        return [	
			
			'attachment',
		];
	}

	
	
}

?>

