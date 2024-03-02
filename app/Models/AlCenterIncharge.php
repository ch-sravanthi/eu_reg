<?php 
namespace App\Models;

use App\Models\CenterIncharge;
use App\Models\Person;
use App\AppModel;

class AlCenterIncharge extends CenterIncharge{

	public $fillable = [		
		'location',
        'location_latlong',	
		'people_group',
	
		'name_advisor_1',
		'address_advisor_1',
		'position_advisor_1',  

		'name_advisor_2',
		'address_advisor_2',
		'position_advisor_2',  

		'name_advisor_3',
		'address_advisor_3',
		'position_advisor_3',  
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
		return array_merge(parent::rules(), $this->thisRules());
	}

	
	public function all_rules()
	{
		return array_merge(parent::rules(), $this->thisRules(), $this->mapRules());
	}
	
	public function thisRules()
	{	return  [			
           'location' => 'required',
            'location_latlong' => 'required',
			/*'people_group' => 'required',
			
			'name_advisor_1' => 'required',
			'address_advisor_1'=> 'required',
			'position_advisor_1'=> 'required',
			
			'name_advisor_2' => 'nullable',
			'address_advisor_2'=> 'nullable|required_with:name_advisor_2',
			'position_advisor_2'=> 'nullable|required_with:name_advisor_2',
			
			'name_advisor_3' => 'nullable',
			'address_advisor_3'=> 'nullable|required_with:name_advisor_3',
			'position_advisor_3'=> 'nullable|required_with:name_advisor_3',
            'phone_mobile' => 'nullable|mobile',
			
            'dec_copy' => 'nullable|mimes:jpg,jpeg,png,pdf|min: 20|max: 1024',*/
		];
	}
	
	public function mapRules()
		{
			return  [			
			   'location' => 'required',
			   'location_latlong' => 'required',
				
		];
	}
	public function niceNames()
	{
		return[			
			'status' => 'Status',
			'review_status' => 'Review Status',
			'code' => 'Assistant Code',		
			'status_details' => 'Status',
			'assistant_details' => 'Assistant Details',
            'location' => 'Location of the Center',
			'location_latlong' => 'Latitude & Longitude',
            'people_group' => 'People Group',
			'photo' => 'Photo',
			'address_proof_copy' => 'Address Proof Copy',
			'testimony_copy' => 'Testimony Copy',
            'declaration_copy' => 'Declaration Copy',
            'dec_copy' => 'Declaration Copy',
            'application_copy' => 'Profile Copy',
			
			'location_label' => 'Center Location',
			'advisors_label' => 'Village Advisors',
			'full_name' => 'Assistant Name',
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
    public function project()
    {
        return $this->belongsTo('App\Models\AlProject');
    }
	
	/**
     * Relationship Al Learner
     */
    public function center_beneficiaries()
    {
        return $this->hasMany('App\Models\AlLearner','center_incharge_id');
    }
	
	/**
     * Relationship AL TTP
     */
    public function al_ttp()
    {
        return $this->hasOne('App\Models\AlTtpParticipant', 'center_incharge_id');
    }
	
	/**
     * Relationship New AL TTP
     */
    public function new_al_ttp()
    {
        return $this->hasOne('App\Models\NewAlTtpParticipant', 'center_incharge_id');
	}
	
	/**
     * Relationship Center Visit
     */
    public function center_visits() {
        return $this->hasMany('App\Models\AlCenterVisit', 'center_incharge_id');
    }
	
	public function ds_annual_program() {
        return $this->hasOne('App\Models\DsAnnualProgramParticipant', 'al_center_incharge_id');
    }
	/**
     * Relationship AL Eo TO
    */
    public function al_eo_tos()
    {
        return $this->hasMany('App\Models\AlEoTo', 'center_incharge_id');
	} 
	
	/**
     * Relationship Case History
     */
    public function case_histories()
    {
        return $this->hasMany('App\Models\CaseHistory', 'al_center_incharge_id');
	}
	public function prayer_requests()
    {
        return $this->hasMany('App\Models\AlPrayerRequest', 'center_incharge_id');
	}
	public function praise_points()
    {
        return $this->hasMany('App\Models\AlPraisePoint', 'center_incharge_id');
	}
	public function fris()
    {
        return $this->hasMany('App\Models\AlFri', 'center_incharge_id');
	}
	
    public function replacement()
    {
        return $this->hasOne('App\Models\AlCenterIncharge', 'replacement_id');
    }
	
    public function parent()
    {
        return $this->belongsTo('App\Models\AlCenterIncharge', 'replacement_id');
    }
	
	public function bankmaster_records()
    {
        return $this->hasMany('App\Models\AlBankmasterRecord', 'center_incharge_id');
    }
	/**
     * Relationship Payment
     */
	public function payments()
    {
        return $this->hasMany('App\Models\AlProjectPayment', 'center_incharge_id');
    }
	/**
     * Relationship Visits
    */
	public function ia_center_visits(){
         return $this->hasMany('App\Models\Ia\IaAlCenterVisit', 'center_incharge_id');
    }
	public function programs() {
		return [
			'al_ttp' => 'AL TTP',
		];
	}
	public function title()
	{
		return 'AL Assistants';
	}
	
	
	public function getNameTypeAttribute()
    {
        return 'AL Assistant';
    }	
	/**
     * Relation Logs
     */
    public function logs() {
		$class = new class extends \App\Audit{ protected $table = 'al_center_incharge_logs';};
        return $this->hasMany(get_class($class), 'parent_id');		
	}
	
	public function relations() {
		return [
			'project' => ['belongsTo', AlProject::class],
			'person' => ['belongsTo', Person::class],
		];		
	}
}