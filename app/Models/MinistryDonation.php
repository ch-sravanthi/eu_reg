<?php

namespace App\Models;

use App\AppModel;
//use Auth;
use App\Helpers\AppHelper;
use Illuminate\Notifications\Notifiable;

class MinistryDonation extends AppModel
{
	 use Notifiable;
	//abstract public function settlement_records();
	
    protected $fillable = [
	
		'project_code',
		'name',
		'phone',
		'email',
		'state',
		'district',
		'pin',
		'address',
		

    ];
	
	public function niceNames()
	{   
        return [		
				
				'project_code' > 'Project Code',
				'name' => 'Name',
				'phone' => 'Phone',
				'email' => 'Email',
				'state' => 'State',
				'pin' => 'Pin Code',
				'district' => 'District',
				'address' => 'Address',
				
			];
	}

	
	
}

?>

