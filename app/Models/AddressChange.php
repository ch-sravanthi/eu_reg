<?php

namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;


class AddressChange extends AppModel
{
    
	protected $fillable = [
		'full_name',
		'phone_no',
		'email',
		'old_address',
		'new_address',
		'pincode',
		'reference_number',
	];
	 
	
	public function rules()
	{
		
		return [
				'full_name'=>'required|max:255',
				'phone_no'=>'required|mobile',
				'email'=>'required|email',
				'old_address'=>'required',
				'new_address'=>'required',
				'pincode'=>'required',
				'reference_number'=>'required',
			];
	}
	
	public $nicenames =  [
			
		'full_name' => 'Name',
		'phone_no' => 'Phone Number',
		'email' => 'Email',
		'old_address' => 'Old Address',
		'new_address' => 'New Address',
		'pincode' => 'New Pincode',
		'reference_number' => 'Transaction Reference Number',
	];
	
	public function niceNames()
	{
		return[
			'full_name' => 'Name',
			'phone_no' => 'Phone Number',
			'email' => 'Email',
			'old_address' => 'Old Address',
			'new_address' => 'New Address',
			'pincode' => 'New Pincode',
			'reference_number' => 'Reference Number',
		];
	}
}
