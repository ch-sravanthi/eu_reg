<?php 
namespace App\Models;

use App\Models\CenterIncharge;
use App\Models\Person;
use App\Auditable;

class AscCenterIncharge extends CenterIncharge{

	use Auditable;
	public $fillable = [		
		'location',
        'location_latlong',	
		'people_group', 
		'beginner_girls',
		'beginner_boys',
		'primary_girls',
        'primary_boys',
        'junior_girls',
        'junior_boys',
        'inter_girls',
        'inter_boys',
        'senior_girls',
        'senior_boys',
		
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
		return array_merge($parent_rules, $this->thisRules());
	}
	
	public function thisRules() {
		return [			
           // 'location' => 'required',
          //  'location_latlong' => 'required',
			'people_group' => 'required',
			'beginner_girls' => 'required',
			'beginner_boys' => 'required',
			'primary_girls' => 'required',
			'primary_boys' => 'required',
			'junior_girls' => 'required',
			'junior_boys' => 'required',
			'senior_girls' => 'required',
			'senior_boys' => 'required',
			'inter_girls' => 'required',
			'inter_boys'=> 'required',
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
			'code' => 'Center Code',
			
			'status_details' => 'Status',
			'club_leader_details' => 'Club Leader Details',
            'location' => 'Location of the Center',
			'location_latlong' => 'Latitude & Longitude',
            'people_group' => 'People Group',
			
			'beginner_girls' => 'Beginner Girls',
			'beginner_boys' => 'Beginner Boys',
			'primary_girls' => 'Primary Girls',
			'primary_boys' => 'Primary Boys',
			'junior_girls' => 'Junior Girls',
			'junior_boys' => 'Junior Boys',
			'senior_girls' => 'Senior Girls',
			'senior_boys' => 'Senior Boys',
			'inter_girls' => 'Inter Girls',
			'inter_boys' => 'Inter Boys',
			'photo' => 'Photo',
			'address_proof_copy' => 'Address Proof Copy',
			'testimony_copy' => 'Testimony Copy',
            'declaration_copy' => 'Declaration Copy',
            'dec_copy' => 'Declaration Copy',
            'application_copy' => 'Profile Copy',
			
			'children_enrolled_label' => 'Children Proposed',
			'location_label' => 'Center Location',
			'full_name' => 'Club Leader Name',
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
        return $this->belongsTo('App\Models\AscProject');
    }
	
	/**
     * Relationship Asc Center Incharge Status
     */
	public function center_statuses() {
        return $this->hasMany('App\Models\AscCenterStatus', 'center_id');
	}	
	
	/**
     * Relationship Asc Ltp
     */
    public function asc_ltp()
    {
        return $this->hasOne('App\Models\AscLtpParticipant', 'center_incharge_id');
    }
	
	/**
     * Relationship New Asc Ltp
     */
    public function new_asc_ltp()
    {
        return $this->hasOne('App\Models\NewAscLtpParticipant', 'center_incharge_id');
    }
	
	/**
     * Relationship Asc ELtp
     */
    public function asc_eltp()
    {
        return $this->hasOne('App\Models\AscEltpParticipant', 'center_incharge_id');
    }
	
	public function ds_annual_program() {
        return $this->hasOne('App\Models\DsAnnualProgramParticipant', 'asc_project_incharge_id');
    }
	
	 /**
     * Relationship Case History
     */
    public function case_histories()
    {
        return $this->hasMany('App\Models\CaseHistory', 'asc_center_incharge_id');
	}
	
	public function fris()
    {
        return $this->hasMany('App\Models\AscFri', 'center_incharge_id');
	}
	public function prayer_requests()
    {
        return $this->hasMany('App\Models\AscPrayerRequest', 'center_incharge_id');
	}
	public function praise_points()
    {
        return $this->hasMany('App\Models\AscPraisePoint', 'center_incharge_id');
	}
	
	/**
     * Relationship Visits
     */
	public function ia_center_visits(){
         return $this->hasMany('App\Models\Ia\IaAscCenterVisit', 'center_incharge_id');
    }
	
    public function replacement()
    {
        return $this->hasOne('App\Models\AscCenterIncharge', 'replacement_id');
    }
	
    public function parent()
    {
        return $this->belongsTo('App\Models\AscCenterIncharge', 'replacement_id');
    }
	
	public function bankmaster_records()
    {
        return $this->hasMany('App\Models\AscBankmasterRecord', 'center_incharge_id');
    }	
	
	/**
     * Relationship Payment
     */
	public function payments()
    {
        return $this->hasMany('App\Models\AscProjectPayment', 'center_incharge_id');
    }
	
	/**
     * Relationship Center Visit
     */
    public function center_visits() {
        return $this->hasMany('App\Models\AscCenterVisit', 'center_incharge_id');
    }
	
	
	
	public function programs() {
		return [
			'asc_ltp' => 'ASC LTP',
		];
	}
	
	public function title()
	{
		return 'ASC Club Leaders';
	}
	
	public function getNameTypeAttribute()
    {
        return 'ASC Club Leader';
    }	
	/**
     * Relation Logs
     */
    public function logs() {
		$class = new class extends \App\Audit{ protected $table = 'asc_center_incharge_logs';};
        return $this->hasMany(get_class($class), 'parent_id');		
	}
}