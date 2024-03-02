<?php 
namespace App\Models;

use App\Models\CenterIncharge;
use App\Models\Person;
use App\AppModel;
use AppHelper;

class IctCenterIncharge extends CenterIncharge{

	public $fillable = [
		'is_facilitator_related',
		'facilitator_relationship',
		
		'edu_institution_1',
        'degree_1',	
        'degree_from_1',	
        'degree_to_1',
		
		'edu_institution_2',
        'degree_2',	
        'degree_from_2',	
        'degree_to_2',
		
		'location_1',
		'location_1_latlong',
		'people_group_1',
		
		'location_2',
		'location_2_latlong',
		'people_group_2',
		
		'location_3',
		'location_3_latlong',
		'people_group_3',
		
		'replacement_id',
		'review_status',
		'title',
		'testimony',
		'educational_qualifications',
		'previous_exp',
		'min_exp',
		'phone_mobile',
		'marital_status',
		'children_count',
		
	];

	public function rules()
	{
		$parent_rules = parent::rules();
		$parent_rules['previous_exp'] = 'nullable'; // no previous_exp for student
		return array_merge($parent_rules, $this->thisRules());
	}
	
	public function thisRules() {
		return [
			'is_facilitator_related' => 'required',
			'facilitator_relationship' => 'required_if:is_facilitator_related,yes',
			'people_group_1' => 'required',
			
			'people_group_2' => 'nullable',
			
			'people_group_3' => 'nullable',
		];
	}
	
	public function mapRules1() {
		return [			
			'location_1' => 'required',
			'location_1_latlong' => 'required',
		];
	}
	public function mapRules2() {
		return [
			'location_2' => 'required_with:people_group_2',
			'location_2_latlong' => 'required_with:people_group_2',
		];
	}
	public function mapRules3() {
		return [			
			'location_3' => 'required_with:people_group_3',
			'location_3_latlong' => 'required_with:people_group_3',
		];
	}
	
	public function niceNames()
	{
		return[
			
        	'status' => 'Status',
        	'review_status' => 'Review Status',
			'code' => 'Student Code',
			
			'is_facilitator_related' => 'Are You Relative of the Facilitator',
			'facilitator_relationship' => 'What is the Relationship?',
			
			'photo' => 'Photo',
			'address_proof_copy' => 'Address Proof Copy',
            'declaration_copy' => 'Declaration Copy',
            'dec_copy' => 'Declaration Copy',
			'testimony_copy' => 'Testimony Copy',
			'application_copy' => 'Profile Copy',
			'status_details' => 'Status',
			'student_details' => 'Student Details',
			'educational_qualifications' => 'Educational Qualifications',
			'adopted_areas_of_people_groups' => 'Area and People Groups',
			'other' => 'Other Details',
			'full_name' => 'Student Name',
		     'replacement_id' => 'Replace With',
			'title' => 'Title',
			'testimony' => 'Personal Testimony',
			'educational_qualifications' => 'Educational Qualifications',
            'previous_exp' => 'Any previous Experience',
            'min_exp' => 'Ministry Experience',
            'phone_mobile' => 'Mobile No.',
            'marital_status' => 'Marital Status',
            'children_count' => 'No.of Children',
			
			'gender' => 'Gender',
			'project_code' => 'Project Code',
			'zone' => 'Zone',
			'state' => 'State',
		];
	}
	
    /**
     * Relationship Project
     */
    public function project() {
        return $this->belongsTo('App\Models\IctProject');
    }
	
	 /**
     * Relationship Reports
     */
	public function ict_reports(){
        return $this->hasMany('App\Models\IctReport');
    }
	
	 /**
     * Relationship Visits
     */
	public function ia_center_visits(){
         return $this->hasMany('App\Models\Ia\IaIctCenterVisit', 'center_incharge_id');
    }
	/**
     * Relationship ICT Center Incharge Status
     */
	public function center_statuses() {
        return $this->hasMany('App\Models\Ict\IctCenterStatus', 'center_id');
	}		
	 
	public function mid_term() {
        return $this->hasOne('App\Models\IctMidTerm', 'center_incharge_id');
	}
	
	public function ds_annual_program() {
        return $this->hasOne('App\Models\DsAnnualProgramParticipant', 'ict_project_incharge_id');
    }
	
	  /**
     * Relationship Case History
     */
    public function case_histories()
    {
        return $this->hasMany('App\Models\CaseHistory', 'ict_center_incharge_id');
	}
	public function fris()
    {
        return $this->hasMany('App\Models\IctFri', 'center_incharge_id');
	}
	public function prayer_requests()
    {
        return $this->hasMany('App\Models\IctPrayerRequest', 'center_incharge_id');
	}
	public function praise_points()
    {
        return $this->hasMany('App\Models\IctPraisePoint', 'center_incharge_id');
	}
	
    public function replacement()
    {
        return $this->hasOne('App\Models\IctCenterIncharge', 'replacement_id');
    }
	
    public function parent()
    {
        return $this->belongsTo('App\Models\IctCenterIncharge', 'replacement_id');
    }
	
	public function bankmaster_records()
    {
        return $this->hasMany('App\Models\IctBankmasterRecord', 'center_incharge_id');
    }	
	
	/**
     * Relationship Payment
     */
	public function payments()
    {
        return $this->hasMany('App\Models\IctProjectPayment', 'center_incharge_id');
    }	
	
	/**
     * Relationship Center Visit
     */
    public function center_visits() {
        return $this->hasMany('App\Models\IctCenterVisit', 'center_incharge_id');
    }
	
	public function getViewOptions(){
		return "ict.ict_center_incharge.options";
	}
	
	public function programs() {
		return [];
	}
	
	public function title()
	{
		return 'ICT Community Volunteers';
	}
	public function isValid($project, $person, $add = true) {
        
		$project_year = $project->project_year;		
		$address_proof_id = $person->address_proof_id;
		$incharges = $person->inchargeByYear($project_year, false);
		
		$limit = ($add) ? 0 : 1;
		
		$hasExceeded = count($incharges) > $limit;
		if ($hasExceeded) {
			return false;
		}
		
		// for ICT student, check also he is not old student
		$ict_center_incharges_count = IctCenterIncharge::whereHas('person', function($query) use($address_proof_id) {
										$query->where('address_proof_id', $address_proof_id);
									})->count();
		
		if ($ict_center_incharges_count > $limit) {
			return false;
		}
				
		return true;
	}
	
	public function getReport($term) {
		return $report = $this->ict_reports->where('term', $term)->where('deleted_at',NULL)->where('ict_project_report_id','<>',NULL)->first();
		
	}
	
	public function getFullCodeAttribute() {			
		return  $this->code ? $this->project->project_code.'-'.$this->code : null;
	}
	
	/*public function code($isTtp = false) {		
		$project = $this->project;	
		return $project->project_code.'-'.$this->code;
	}*/
	
	public function shortcode($isTtp = false) {		
		$project = $this->project;	
		return AppHelper::code($project->project_code).'-'.$this->code;
	}
	
	public function getNameTypeAttribute()
    {
        return 'ICT Student';
    }	
	/**
     * Relation Logs
     */
    public function logs() {
		$class = new class extends \App\Audit{ protected $table = 'ict_center_incharge_logs';};
        return $this->hasMany(get_class($class), 'parent_id');		
	}
	
	public function relations() {
		return [
			'person' => ['belongsTo', Person::class],
		];		
	}
}