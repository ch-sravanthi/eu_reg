<?php
namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;

class MoreLink extends AppModel{
	

    protected $fillable = [
        'link_url',
        

    ];
	public function rules()
	{
			
		return [
			
			'link_url' =>"required|url"
			
		];
	}
	
    public $nicenames =  [
						
			'link_url' => 'URLs',						
			
        ];
		
	public function niceNames()
	{
		return[
								
			'link_url' => 'URLs',	
			'status' => 'Status',
		];
	}
	public function searchNames()
	{
		return [
			  
			  'link_url',
		];
	}
}