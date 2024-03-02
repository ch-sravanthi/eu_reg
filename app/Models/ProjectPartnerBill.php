<?php
namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;
use Auth;


class ProjectPartnerBill extends AppModel
{	
	 protected $fillable = [
        'project_code',
		'name',
		'email',
		'phone',
    ];

	public function rules()
	{
        return[	
			//'project_code' => 'required',
			'name' => 'required',
			'email' => 'required|email',
			'phone' => 'required|mobile',
        ];
	}
	
	
	public function niceNames()
	{
		return[		
				'project_code' => 'Project Code (serial no. only)',
				'project_year' => 'Project Year',
				'total_amount' => 'Total Amount',
				'name' => 'Name',
				'email' => 'Email',
				'phone' => 'Mobile Number',		
		];
	}
	public function route() {
		return route('project_partner_bill.view', [$this->name(), $this->id]);	
	}
	

		
}
