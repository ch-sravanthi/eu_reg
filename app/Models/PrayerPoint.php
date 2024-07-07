<?php

namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;


class PrayerPoint extends AppModel
{
    
	protected $fillable=[
		'full_name',
		'email',
		'mobile',
		'eu_name',
		'responsibility',
		'region',
		'district',
		'place',
		'thank_god',
		'prayer',
	];
	
	
	public function rules()
	{
		
		return[
			'full_name'	=>	'required',
			'email'	=>	'required',
			'mobile' =>	'required',
			'eu_name' => 'required',
			'responsibility' => 'required',
			'region' => 'required',
			'district' => 'required',
			'place' => 'required',
			'thank_god' => 'required',
			'prayer' => 'required',
			
		];
	}
	
	public $nicenames =  [
		 'full_name' => 'Name',
		 'email' => 'Email ID',
		 'mobile' => 'Mobile Number',
		 'eu_name' => 'EU Name',
		 'responsibility' => 'You’re Responsibility in EU/EGF Committee',
		 'region' => 'Region',
		 'district' => 'District',
		 'place' => 'Place',
		 'thank_god' => 'Thank God for',
		 'prayer' => 'Pray for',
	];
	public function niceNames()
	{
		return[
			'full_name' => 'Name',
			 'email' => 'Email ID',
			 'mobile' => 'Mobile Number',
			 'eu_name' => 'EU Name',
			 'responsibility' => 'You’re Responsibility in EU/EGF Committee',
			 'region' => 'Region',
			 'district' => 'District',
			 'place' => 'Place',
			 'thank_god' => 'Thank God for',
			 'prayer' => 'Pray for',
			 ];
	}
	
}
