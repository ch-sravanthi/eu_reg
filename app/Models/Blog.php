<?php
namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;

class Blog extends AppModel{
	

    protected $fillable = [
        'blog_title',
        'category',
        'location',
        'last_date',
        'description',
        'image_1',
        'image_2',
        'person_name',
        'person_mobile',
        'person_email',

    ];
	public function rules()
	{
			
		return [
			'blog_title' => 'required',
			'category' => 'required',
			'location' => 'nullable',
			'last_date' => 'nullable',
			'description' => 'nullable',
			'image_1' => 'nullable|mimes:jpg,jpeg,png|max: 1024',
			'image_2' => 'nullable|mimes:jpg,jpeg,png|max: 1024',
			'person_name' => 'required',
			'person_mobile' => 'required|mobile',
			'person_email' => 'required|email',
		];
	}
	
    public $nicenames =  [

			'blog_title' => 'Job Title',						
			'category' => 'Job Category',						
			'location' => 'Job Location',						
			'last_date' => 'Last Date to Apply',						
			'description' => 'Job Description',						
			'image_1' => 'Attachment - 1',
			'image_2' => 'Attachment - 2',
			'person_name' => 'Your Full Name',
			'person_mobile' => 'Your Cell Number',
			'person_email' => 'Your Email-id',
			'status' => 'Status',
        ];
		
	public function niceNames()
	{
		return[
			'blog_title' => 'Job Title',						
			'category' => 'Job Category',						
			'location' => 'Job Location',						
			'last_date' => 'Last Date to Apply',						
			'description' => 'Job Description',						
			'image_1' => 'Attachment - 1',
			'image_2' => 'Attachment - 2',
			'person_name' => 'Your Full Name',
			'person_mobile' => 'Your Cell Number',
			'person_email' => 'Your Email-id',
			'status' => 'Status',
		];
	}
	public function searchNames()
	{
		return [
			  'blog_title',
			  'description',
		];
	}

	public function dropDownNames()
	{
		return [
			
			'category' => 'category',
		];
	}
}