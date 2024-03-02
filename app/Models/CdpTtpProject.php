<?php
namespace App\Models;

use App\Models\Project;
use AppHelper;
//use App\Auditable;
use App\Models\CdpTtpProjectPayment;

class CdpTtpProject extends Project
{ 
	///use Auditable; 
	   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $fillable = [
		'project_year',
		'special_project',
		'status',
		'application_status',
        'state',
        'district',
		'fcra',
		'intrest',
        'impact', 
		'location',
		'location_latlong',
		'training_present_address',
		'ttp_state',
		'ttp_district',
		'ttp_taluk',
		'ttp_street',
		'ttp_house_no',
		'ttp_pin_code',
		'planning_to_reach',
		'no_of_programs',
		'package',
		'proposed_date_one',
		'proposed_date_two',
		'ten_day_proposed_date',
		'ten_day_proposed_from_date',
		'training_resources',
		'training_resources_type',
		'teacher_trainers',
		'trainers_info',
		'christian_children',
		'non_christian_children',
		'total',
		'status',
		
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
	public function rules ()
	{
        return [
			
			'special_project' => 'nullable',
			'state' => 'required',
			'district' => 'required',
			'fcra' => 'nullable',
			'intrest' => 'required',
            'impact' => 'required',
			'training_present_address' => 'required',
			'ttp_state' => 'required_if:training_present_address,No',
			'ttp_district' => 'required_if:training_present_address,No',
			'ttp_taluk' => 'required_if:training_present_address,No',
			'ttp_street' => 'required_if:training_present_address,No',
			'ttp_house_no' => 'required_if:training_present_address,No',
			'ttp_pin_code' => 'required_if:training_present_address,No',
			'no_of_programs' => 'nullable|numeric|min:1',
			'package' => 'required',
			'proposed_date_one' => 'required',
			'proposed_date_two' => 'required|date|after_or_equal:proposed_date_one',
			'ten_day_proposed_from_date' => 'required',
			'ten_day_proposed_date' => 'required|date|after_or_equal:ten_day_proposed_from_date',
			'training_resources' => 'required',
			'training_resources_type' => 'nullable|required_if:training_resources,Yes',
			'teacher_trainers' => 'required',
			'trainers_info' => 'nullable|required_if:teacher_trainers,Yes',
			'christian_children' => 'required',
			'non_christian_children' => 'required',
			'location' => 'required',
			'location_latlong' => 'required',
			
        ];
	}
	
    /**
     * Get the labels to display in forms.
     *
     * @return array
     */
     public function niceNames () {

		return [
			'location' => 'Location For The TTP',
			'location_latlong' => 'Latitude & Longitude',		
			'training_present_address' => 'Is the TTP Training venue same as the Present Address of Incharge',
			'ttp_state' => 'State',
			'ttp_district' => 'District',
			'ttp_taluk' => 'Mandal/Taluk',
			'ttp_street' => 'Street',
			'ttp_house_no' => 'House No',
			'ttp_pin_code' => 'Pincode',
			//'planning_to_reach' => 'How many children are you planning to reach',
			'no_of_programs' => 'No. of Programs',
			
			'proposed_date_one' => 'Proposed Training Date',
			'proposed_date_two' => 'Alternate Proposed Training Date',
			'ten_day_proposed_date' => 'To Date',
			'ten_day_proposed_from_date' => 'From Date',
			
			'training_resources' => 'Do you have training resources',
			'training_resources_type' => 'What Are The Training Resources Available',
			'teacher_trainers' => 'Do You Have Trainers To Train Teachers',
			'christian_children' => 'No. of Christian Children To Attend',
			'non_christian_children' => 'No. of Non-Christian Children To Attend',
			
		//	'training_venu_address' => 'Venue & Address of the Training to be conducted',
			'project_code' => 'Project Code',
			'project_year' => 'Project Year',
			'special_project' => 'Special Project Type',
			'entity' => 'Entity',
			'zone' => 'Zone',
			'state' => 'State',
			'district' => 'District',
			'status' => 'Approval Status',
			'application_status' => 'Application Status',
			'fcra' => 'is FCRA',
			'package' => 'How many children are you planning to reach',
			'total' => 'Total',
			
			'trainers_info' => 'Where Do You Get These Trainers',
			'project_details' => 'Project Details',
			'project_location_label' => 'Project Location',
			'other_details_label' => 'Other Details',
			'start_date' => 'Start Date',
			'end_date' =>'End Date',
			'asc_project' =>'ASC Project',
			'organization_name' => 'Organization Name',
			'organization_head' => 'Organization Head',
			'full_name' => 'Facilitator',
			'staff_id' => 'Assigned Staff',
			'intrest' => 'Why are you intrested in this program',
            'impact' => 'How are you going to Impact Society',
		];
	}
	
	/**
     * Get the program request that owns the project.
     */
    public function program_request()
    {
        return $this->belongsTo('App\Models\CdpTtpProgramRequest', 'program_request_id');
    }
	
	// Relation Assigned Staff
	public function asc_project()    {
        return $this->hasOne('App\Models\AscProject');
    }
	
	/**
     * Get the organization that owns the project.
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }
	
    /**
     * Get the project incharges for the project.
     */
    public function project_incharges()
    {
        return $this->hasMany('App\Models\CdpTtpProjectIncharge', 'project_id');
    }
	
    /**
     * Get the ten day plan for the project.
     */
    public function cdp_ten_day_plan()
    {
        return $this->hasOne('App\Models\CdpTenDayPlan', 'project_id');
    }
	/**
     * Relationship CDP TTP Report
     
	public function cdp_ttp_report()
    {
        return $this->hasOne('App\Models\CdpTtpReport', 'project_id');
    }*/
	/**
     * Get the Donation for the project.
     */
    public function donation()
    {
        return $this->hasOne('App\Models\CdpTtpDonation', 'project_id');
    }
	
	/**
     * Get the preinvestigation for the project.
     */
    public function preinvestigation()
    {
        return $this->hasOne('App\Models\CdpPreinvestigation', 'project_id');
    }
	/**
     * Relationship Project Status
     */
	public function project_statuses() {
        return $this->hasMany('App\Models\CdpTtpProjectStatus', 'project_id');
	}	
	
	// Relation Assigned Staff
	public function assigned_staffs()    {
        return $this->hasMany('App\Models\CdpTtpAssignedStaff', 'project_id');
    }
	
	
	/**
     * Relationship Approval Record
     */
    public function approval_record()
    {
        return $this->hasOne('App\Models\CdpTtpProjectApprovalRecord', 'project_id');
    }
	
	public function project_bills()
    {
        return $this->hasMany('App\Models\CdpTtpProjectPartnerBill', 'project_id');
    }
	
	/**
     * Relationship Log
     */
    public function logs()
    {
        $class = new class extends \App\Audit{ protected $table = 'cdp_ttp_project_logs';};
        return $this->hasMany(get_class($class), 'parent_id');
    }
	
	public function relations() {
		return [
			'active_project_incharge' => ['belongsTo', CdpTtpProjectIncharge::class],
			'cdp_ttp_report' => ['hasOne', CdpTtpReport::class],
		];		
	}
	protected static function boot()
    {
		parent::boot();
		
		
		// add project code while saving for approved projects
		static::saved(function ($model) {
			if ($model->status == 'approved' && !$model->donation) {
				$donation = new CdpTtpDonation;
				$donation->no_of_pendrives = 0;
				$model->donation()->save($donation);
			}
        });
					
	}
	public function newProjectCode($newCode) {
		$ttps = $this->no_of_programs;
		$ttps = ($ttps < 10) ? '0'.$ttps : $ttps;
		
		$code = str_replace('CDP', 'TTP', $this->project_year) . "-" 
		      . $newCode . "-" 
			  . AppHelper::dropdown($this->zone, 'zone_shortcodes') . "-" 
			  . $this->state . "-" 
			  . $this->district . "-" 
			  . $this->entity . "-"
			  . $ttps;
			  
		if ($this->special_project != 'R'){
			$code.= '-'.$this->special_project;
		}
		return strtoupper($code);
	}
	
	public function newCode() {
		$codes_initial = AppHelper::options('codes_initial');
		$starting = $codes_initial['cdp'];
		return $starting + $this::whereNotNull('project_code')->count() + 1;
	}
	
	public function centers(){
		return $this->no_of_programs;
	}
	
	public function packages() {
		return $this->package;
	}
	
	public function billsRequired($category) {
		return !in_array($category, ['ttp', 'pop']);
	}
	
	public function reportsRequired() {
		/*
		if (in_array($this->special_project, ['SS', 'C']) && $this->cdp_ten_day_plan->total_programs > 1) {
			return 2;
		}*/
		return 1;
	}
	
	public function location() {
		return AppHelper::location($this->code(), $this->special_project, $this->location_latlong);
	}
	
	public function getTtpDonation() {
		//var_dump($this->donation);die();
		if(!$this->donation){		
			$cdp_ttp_donation = new CdpTtpDonation;	
			$cdp_ttp_donation->no_of_pendrives =0;
			$cdp_ttp_donation->created_by = 773;
			$this->donation()->save($cdp_ttp_donation);	
			return $cdp_ttp_donation;
		}else{
			return $this->donation;
		}		
	}
	
	public function projectAmount(){
		
		$package = intval($this->package);		
		
		if($this->special_project == 'CS'){
			return 15000;
		} elseif (in_array($this->special_project, ['SS', 'DS'])) {
			if($package <= 1500){			
				return 6600;
			}elseif($package <= 2000){	
				return 8800;
			}elseif($package <= 2500){	
				return 11000;
			}else{
				return 15000;
			}
		}
		return 0;
	}
	
	public function payment(){
		
		$project_id = $this->id;
		return CdpTtpProjectPayment::whereHas('project_incharge', function($q) use($project_id){
											$q->where('project_id', $project_id);
										})
										->where('term', 'ttp')
										->first();
	}
	
	public function code() {
		return $this->project_code;
	}
	
	public function hasRequiredCenters(){
		return true;
	}
	
	public function canSubmit(){	

		return  true;
	}
}
