<?php
namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;

class Complaint extends AppModel
{
	
	protected $table = 'complaints';
	
	protected $fillable = [
		'full_name',
		'phone_no',
		'district',
		'email',
		'complaint_message',
	];
	
	public $nicenames =  [
			
		'full_name' => 'Name',
		'phone_no' => 'Phone Number',
		'district' => 'District',
		'email' => 'Email',
		'complaint_message' => 'Complaint Message',
	];
	
	public function rules()
	{
		
	return [
				'full_name' => 'required|max:255',
				'phone_no' => 'required|mobile',
				'district' => 'required',
				'email' => 'required|email',
				'complaint_message' => 'required',
			];
	}
}
