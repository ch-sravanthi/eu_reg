<?php

namespace App\Models;

use App\AppModel;
//use Auth;
use App\Helpers\AppHelper;
use Illuminate\Notifications\Notifiable;

class Donation extends AppModel
{
	 use Notifiable;
	//abstract public function settlement_records();
	
    protected $fillable = [
	
		'title',
		'name',
		'phone',
		'email',
		'state',
		'district',
		'pin',
		'address',
		'staff_name',
		'remarks',
    ];
	
	public function niceNames()
	{   
        return [		
				
				'title' => 'Title',
				'name' => 'Name',
				'phone' => 'Phone',
				'email' => 'Email',
				'state' => 'State',
				'pin' => 'Pin Code',
				'district' => 'District',
				'address' => 'Address',
				'staff_name' => 'Staff who inspired/contacted you',
				'remarks' => 'Remarks',
			];
	}

	
	
}

?>

