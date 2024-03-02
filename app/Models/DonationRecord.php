<?php

namespace App\Models;

use App\AppModel;
//use Auth;
use App\Helpers\AppHelper;

class DonationRecord extends AppModel
{
	public $fillable = [   
		
		'transaction_no',
		'transaction_type',
		'amount',
		'attachment',
		'transaction_date',
		
	];
	
	
	
	
	public function niceNames()
	{   
        return [	
			'transaction_no' => 'Transaction No',
			'transaction_type' => 'Transaction Type',
			'amount' => 'Donation Amount',
			'transaction_date' => 'Transaction Date',
			'attachment' => 'Attachment'
		];
	}

	
	
}

?>

