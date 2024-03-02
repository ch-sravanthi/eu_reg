<?php

namespace App\Models;

use App\AppModel;
//use Auth;
use App\Helpers\AppHelper;
use Illuminate\Notifications\Notifiable;

class CashDonation extends AppModel
{
	 use Notifiable;
	 
	 protected $table = 'cash_donations'; 
	//abstract public function settlement_records();
	
    protected $fillable = [
	
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
    ];
	
	public function rules()
    {
        return [
				'name' => 'required',
				'phone' => 'required',
				'email' => 'required',
				'state' => 'required',
				'pin' => 'required',
				'district' => 'required',
				'address' => 'required',
				'amount'=>'required',
				'language'=>'nullable',
				'donation_received_through'=>'required',
				'language'=>'required_if:donation_received_through,==,P&D M'
				];
    }
	
	public function niceNames()
	{   
        return [		
				
				'name' => 'Name',
				'phone' => 'Phone',
				'email' => 'Email',
				'state' => 'State',
				'pin' => 'Pin Code',
				'district' => 'District',
				'address' => 'Address',
				'amount'=>'Donation Amount',
				'donation_type'=>'Donation For',
				'donation_code'=>'Donation Code',	
				'language'=>'Preferred Language',				
			];
	}
	
}

?>

