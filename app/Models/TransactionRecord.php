<?php

namespace App\Models;

use App\AppModel;
//use Auth;
use App\Helpers\AppHelper;
use Illuminate\Notifications\Notifiable;

class TransactionRecord extends AppModel
{
	 use Notifiable;
	
    protected $fillable = [
	
		'title',
		'name',
		'phone',
		'email',
		'state',
		'district',
		'pin',
		'address',
		'amount',
		'donation_received_through',
		'language',
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
				'amount' => 'Donation Amount',
				'remarks' => 'Remarks',
				
			];
	}

	
	
}

?>

