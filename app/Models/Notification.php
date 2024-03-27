<?php
namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;

class Notification extends AppModel{
	

    protected $fillable = [
        'description',
        'image_1',
		'person_name',
        'person_mobile',
        'person_email',

    ];
	public function rules()
	{
			
		return [
			
			'description' => 'required',
			'image_1' => 'nullable|mimes:jpeg,jpg,png|max:1024',
			
			'person_name' => 'required',
			'person_mobile' => 'nullable|mobile',
			'person_email' => 'nullable|email',
		];
	}
	
    public $nicenames =  [
						
			'description' => 'Job Description',						
			'image_1' => 'Attachment - 1',
			'person_name' => 'Full Name',
			'person_mobile' => 'Cell Number',
			'person_email' => 'Email ID ',
			'status' => 'Status',
        ];
		
	public function niceNames()
	{
		return[
								
			'description' => 'Job Description',						
			'image_1' => 'Attachment - 1',
			
			'person_name' => 'Full Name',
			'person_mobile' => 'Cell Number',
			'person_email' => 'Email ID ',
			'status' => 'Status',
		];
	}
	public function searchNames()
	{
		return [
			  
			  'description',
		];
	}
}