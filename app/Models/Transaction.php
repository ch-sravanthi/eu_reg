<?php

namespace App\Models;

use App\AppModel;
//use Auth;
use App\Helpers\AppHelper;
use Illuminate\Notifications\Notifiable;

class Transaction extends AppModel
{
	 use Notifiable;
	
    protected $fillable = [
		
		'transaction_no',
		'mode_of_payment',
		'amount',
		'attachment',
		'no_of_programs',
		'donation_received_through',
		'transaction_date',

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
			'transaction_no' => 'Transaction No',
			'mode_of_payment' => 'Transaction Type',
			'amount' => 'Transaction Amount',
			'transaction_date' => 'Transaction Date',
			'attachment' => 'Attachment',
			];
	}

	
	
}

?>

