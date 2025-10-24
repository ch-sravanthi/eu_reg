<?php
namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;

class Conference extends AppModel{
	

    protected $fillable = [
        'full_name',
		'email',
		'gender',
		'mobile_no',
		'recommender_type',
		'utr_number',
		'payment_date',
		'region',
		'uesi_district_hyd',
		'uesi_district_rr',
	//	'egf_zone_vikarabad',
		'recommender_name',
		'recommender_mobile',
		'category',
		'attending_as',
		'spouse_name',
		'spouse_contact',
		'children_count',  
		'children_count_below_15',
		'children_count_above_15',
		'child_1_name',
		'child_2_name',
		'child_3_name',
		'registration_fee',
		'transaction_date',
		'transaction_channel',
		'transaction_utr',
		'transaction_remarks',   		
    ];
	public function rules()
	{
			
		return [
			'email' => 'required|email',
			'full_name' => 'required',
			'gender' => 'required',
			'mobile_no' => 'required',
			'recommender_type' => 'required',
			'utr_number' => 'required',
			'payment_date' => 'required',
			'region' => 'nullable',
			'uesi_district_hyd' => 'nullable',
			'uesi_district_rr' => 'nullable',
			'egf_zone' => 'nullable',
			'recommender_name' => 'nullable',
			'recommender_mobile' => 'nullable',
			'category' => 'nullable',
			'attending_as' => 'nullable',
			'spouse_name' => 'nullable',
			'spouse_contact' => 'nullable',
			'children_count' => 'nullable',
			'children_count_below_15' => 'nullable',
			'children_count_above_15' => 'nullable',
			'child_1_name' => 'nullable',
			'child_2_name' => 'nullable',
			'child_3_name' => 'nullable',
			'registration_fee' => 'nullable',
			'transaction_date' => 'nullable',
			'transaction_channel' => 'nullable',
			'transaction_utr' => 'nullable',
			'transaction_remarks' => 'nullable',
		];
	}
	
    public $nicenames =  [
	
			'full_name' => 'Full Name',
			'email' => 'Email Address',
			'gender' => 'Gender',
			'mobile_no' => 'Mobile Number',
			'recommender_type' => 'Who is Recommending You',
			'utr_number' => 'UTR Number',
			'payment_date' => 'Payment Date',
			'region' => 'Region',
			'uesi_district_hyd' => 'UESI District (Hyderabad Region)',
			'uesi_district_rr' => 'UESI District (Rangareddy Region)',
		//	'egf_zone_vikarabad' => 'EGF Zone (Vikarabad)',
			'recommender_name' => 'Name of Recommender',
			'recommender_mobile' => 'Recommender Mobile Number',
			'category' => 'Category',
			'attending_as' => 'Attending As',
			'spouse_name' => 'Spouse Name',
			'spouse_contact' => 'Spouse Contact Number',
			'children_count' => 'Total Number of Children',
			'children_count_below_15' => 'Children (Below 15 Years)',
			'children_count_above_15' => 'Children (Above 15 Years)',
			'child_1_name' => 'First Child Name',
			'child_2_name' => 'Second Child Name',
			'child_3_name' => 'Third Child Name',
			'registration_fee' => 'Registration Fee Amount',
			'transaction_date' => 'Transaction Date',
			'transaction_channel' => 'Channel of Transaction',
			'transaction_utr' => 'Transaction UTR Number',
			'transaction_remarks' => 'Additional Transaction Details',	
			
        ];
		
	public function niceNames()
	{
		return [
			'full_name' => 'Full Name',
			'email' => 'Email Address',
			'gender' => 'Gender',
			'mobile_no' => 'Mobile Number',
			'recommender_type' => 'Who is Recommending You',
			'utr_number' => 'UTR Number',
			'payment_date' => 'Payment Date',
			'region' => 'Region',
			'uesi_district_hyd' => 'UESI District (Hyderabad Region)',
			'uesi_district_rr' => 'UESI District (Rangareddy Region)',
		//	'egf_zone_vikarabad' => 'EGF Zone (Vikarabad)',
			'recommender_name' => 'Name of Recommender',
			'recommender_mobile' => 'Recommender Mobile Number',
			'category' => 'Category',
			'attending_as' => 'Attending As',
			'spouse_name' => 'Spouse Name',
			'spouse_contact' => 'Spouse Contact Number',
			'children_count' => 'Total Number of Children',
			'children_count_below_15' => 'Children (Below 15 Years)',
			'children_count_above_15' => 'Children (Above 15 Years)',
			'child_1_name' => 'First Child Name',
			'child_2_name' => 'Second Child Name',
			'child_3_name' => 'Third Child Name',
			'registration_fee' => 'Registration Fee Amount',
			'transaction_date' => 'Transaction Date',
			'transaction_channel' => 'Channel of Transaction',
			'transaction_utr' => 'Transaction UTR Number',
			'transaction_remarks' => 'Additional Transaction Details',
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