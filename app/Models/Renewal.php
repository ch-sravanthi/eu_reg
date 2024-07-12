<?php
namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;

class Renewal extends AppModel{
	

    protected $fillable = [
        'email',
        'full_name',
        'address',
        'district',
        'pincode',
        'state',
        'other_state',
        'mobile_num',
        'type_of_subscription',
        'amount',
        'date',
        'reference_number',

    ];
	public function rules()
	{
			
		return [
			'email' => 'required|email',
			'full_name' => 'required',
			'address' => 'required',
			'state' => 'required',
			'district' => 'required_if:state,TELANGANA',
			'pincode' => 'required',
			'other_state' => 'nullable',
			'mobile_num' => 'required|mobile',
			'type_of_subscription' => 'required',
			'date' => 'required',
			'reference_number' => 'required',
		];
	}
	
    public $nicenames =  [

			'email' => 'Email',						
			'full_name' => 'Name',						
			'address' => 'Address',						
			'district' => 'District',						
			'pincode' => 'Pincode',						
			'state' => 'State',
			'other_state' => 'Mention Name of the State Other Than TELANGANA',
			'mobile_num' => 'Phone Number',
			'type_of_subscription' => 'Type of Subscription',
			'amount' => 'Transaction Amount',
			'date' => 'Transaction Date',
			'reference_number' => 'Transaction Reference Number (UTR)',
        ];
		
	public function niceNames()
	{
		return[
			'email' => 'Email',						
			'full_name' => 'Name',						
			'address' => 'Address',						
			'district' => 'District',						
			'pincode' => 'Pincode',						
			'state' => 'State',
			'other_state' => 'Mention Name of the State Other Than TELANGANA',
			'mobile_num' => 'Phone Number',
			'type_of_subscription' => 'Type of Subscription',
			'amount' => 'Transaction Amount',
			'date' => 'Transaction Date',
			'reference_number' => 'Transaction Reference Number (UTR)',
		];
	}
	public function searchNames()
	{
		return [
			  'email',
			  'pincode',
		];
	}

	public function dropDownNames()
	{
		return [
			
			'full_name' => 'full_name',
		];
	}
}