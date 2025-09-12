<?php

namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;

class EgfBasicInfo extends AppModel
{
	  
	protected $table = 'egf_basic_infos';
	
	protected $fillable = [
		'year',
		'region',
		'district',
		'revenue_division',
		'egf_name',
		'egf_status',
		'egf_committee_formed',
		'code',  
	];
	
	public function rules()
	{
		return [
		'region'               => 'required|max:255',
		'district'             => 'required|max:255',
		'revenue_division'     => 'required|max:255',
		'egf_name'             => 'required|max:255',
		'egf_status'           => 'required',
	//	'egf_status'           => 'required|in:Affiliated,Provisionally Affiliated,Functional,Contact',
		'egf_committee_formed' => 'required|in:Yes,No',
			
		];
	}
	
	public function niceNames()
	{
		return[
			'year' => 'Year',
			'region' => 'Your Region',
			'district' => 'Your District',
			'revenue_division' => 'Revenue Division to which your EGF belongs to?',
			'egf_name' => 'Name of the EGF',
			'egf_status' => 'Status of the EGF',
			'egf_committee_formed' => 'Was EGF Committee formed for 2024-925?',
			'state' => 'State',
			'status' => 'Status',
			'code' => 'EGF Code'
		];
	}
	
	public function searchNames()
	{
		return [
		];
	}
	
	protected static function boot()
	{
		parent::boot();

		static::updating(function ($model) {
			$original = $model->getOriginal();

			if ($model->status == 'created' && $model->status !== $original['status']) {
				$model->code = $model->newEgfReportID();
			}
		});
	} 
	public function newEgfReportID()
	{
		$baseYear = 2025; // Reference year
		$startingSLN = 1; // Starting serial number (can be made dynamic if needed)
		$yearShort = substr($this->year, -2); // Last two digits of the year
		$SLN = "S" . $startingSLN;
		$stateShortcode = AppHelper::dropdown($this->state, 'state_shortcodes');

		$egf_code = "EGF-" 
			. $yearShort . "-" 
			. $SLN . "-" 
			. $stateShortcode . "-" 
			. $this->state . "-" 
			. $this->district . "-" 
			. $this->revenue_division;

		return strtoupper($egf_code);
	}

 
	 
	public function beginning_report()
	{
		return $this->hasOne('App\Models\EgfReportBeginning', 'egf_report_id');
	}

}
