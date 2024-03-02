<?php 
namespace App\Models;

use App\Models\Project;
use App\Helpers\AppHelper;
//use App\Auditable;

class CdpTtpConveyance extends Project{
       
	//use Auditable; 
	   
	protected $model_title = "CDP TTP Conveyance";
	   
	protected $fillable = [
        'state',
        'district',		
		'fcra',		
        'centers',
		'reason',
		'start_date',
		'end_date',
		'application_status',
	];	
	
	public function rules ()
	{
        return [
			//'special_project' => 'required',
			//'support' => 'required',
			'state' => 'required',
			'district' => 'required',
            'fcra' => 'required',
			'centers' => 'required|numeric',
			'reason' => 'required',
        ];
	}
    
	public function niceNames()
    {
        return [
			'admin'	=> 'Admin',
        	'stages' => 'Stages',
        	'status' => 'Approval Status',
        	'application_status' => 'Application Status',
			'project_code' => 'Project Code',
			'support' => 'Support',
			'special_project' => 'Special Project Type',
			'entity' => 'Entity',
			'zone' => 'Zone',
			'state' => 'State',
			'district' => 'District',
			'fcra' => 'FCRA',
			'swift_code' => 'Swift Code',
			'mi' => 'Prism',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
            'centers' => 'No. of Centers required',			
			'reason' => 'Reason for Partnership',
			'project_details' => 'Project Details',
			'project_location_label' => 'Project Location',
			'other_details_label' => 'Other Details',
			'reason_label' => 'Reasons',
        ];
    }
	
	/**
     * Relationship Cbc Project
     */
    public function cdp_ttp_project()
    {
        return $this->belongsTo('App\Models\CdpTtpProject');
    }
	    
	/**
     * Relationship Project Incharges
     */
	public function project_incharges()
    {
        return $this->hasMany('App\Models\AscProjectIncharge', 'project_id');
    }
			
	
	/**
     * Relationship Center Incharges
     */
	public function center_incharges()
    {
        return $this->hasMany('App\Models\AscCenterIncharge', 'project_id');
    }	
	
	/**
     * Relationship Asc Project Status
     */
	public function project_statuses() {
        return $this->hasMany('App\Models\AscProjectStatus', 'project_id');
	}	
	
	/**
     * Relationship ASC Reports 
     */
	public function asc_reports()
    {
        return $this->hasMany('App\Models\AscReport', 'project_id');
    }
	
	/**
     * Relationship ASC Reports 
     */
	public function asc_enrollments()
    {
        return $this->hasMany('App\Models\AscEnrollment', 'project_id');
    }
	
	/**
     * Relationship Interviewee
     */
	public function asc_interviewees()
    {
        return $this->hasMany('App\Models\AscInterviewee', 'project_id');
    }
	
	
	/**
     * Relationship ASC Project Visit 
     */
	public function asc_project_visits()
    {
        return $this->hasMany('App\Models\AscProjectVisit', 'project_id');
    }
	
	/**
     * Relationship Asc Project Status
     */
	public function project_application_statuses() {
        return $this->hasMany('App\Models\AscProjectApplicationStatus', 'project_id');
	}
	
	/**
     * Relationship Log
     */
    public function logs()
    {
        return $this->hasMany('App\Models\Asc\Log\AscProjectLog', 'parent_id');
    }
	
	/**
     * Relationship Approval Record
     */
    public function approval_record()
    {
        return $this->hasOne('App\Models\AscProjectApprovalRecord', 'project_id');
    }
	
	/**
     * Relationship Project Visits
     */
	public function project_visits()
    {
        return $this->hasMany('App\Models\AscProjectVisit', 'project_id');
    }
	/**
     * Relationship Inauguration
     */
    public function inauguration_report()
    {
        return $this->hasOne('App\Models\AscInaugurationReport', 'project_id');
    }
	
	/**
     * Relationship HEP
     */
    public function hep_initial_report()
    {
        return $this->hasOne('App\Models\AscHepInitialReport', 'project_id');
    }
	
	/**
     * Relationship HEP
     */
    public function first_hep_follow_up_report()
    {
        return $this->hasOne('App\Models\AscFirstHepFollowUpReport', 'project_id');
    }
	
	/**
     * Relationship Project bills
     */
	public function project_bills()
    {
        return $this->hasMany('App\Models\CdpConveyanceBill', 'project_id');
    }
	
		/**
     * Relationship IA Visits
     */
	public function ia_visits()
    {
        return $this->hasMany('App\Models\IaAsc', 'project_id');
    }
	
	// Relation Assigned Staff
	public function assigned_staffs()    {
        return $this->hasMany('App\Models\AscAssignedStaff', 'project_id');
    }
	
	public function getViewOptions(){
		return "asc.asc_project.options";
	}
	
	public function newCode() {
		$codes_initial = AppHelper::options('codes_initial');
		$starting = $codes_initial['asc'];
		return $starting + $this::whereNotNull('project_code')->count() + 1;
	}
		
		
	public function newProjectCode($newCode) {
		$centers = intval($this->centers);
		$centers = ($centers < 10) ? '0'.$centers : $centers;
		$code = $this->project_year. "-" 
		      . $newCode . "-" 
			  . AppHelper::dropdown($this->zone, 'zone_shortcodes') . "-" 
			  . $this->state . "-" 
			  . $this->district . "-" 
			  . $this->entity . "-"
			  . $centers;
		if ($this->special_project != 'R') {
			$code.= '-'.$this->special_project;
		}
		return strtoupper($code);
	}
	
	public function newCenterCode() {
		$newCode = $this->center_incharges->where('code','<>', null)->count() + 1;
		return $this->project_code . '-C' . $newCode;
	}
		
	public function centers() {
		return $this->centers;
	}
	
	public function billsRequired($category) {
		return !in_array($category, ['honorarium']);
	}
	public function getEnrollements() {	
		$enrollments = [
			'beginner_girls' => 0,
			'beginner_boys' => 0,
			'primary_girls' => 0,
			'primary_boys' => 0,
			'junior_girls' => 0,
			'junior_boys' => 0,
			'inter_girls' => 0,
			'inter_boys' => 0,
			'senior_girls' => 0,
			'senior_boys' => 0,
		];
		
		foreach ($this->getCenterIncharges() as $incharge) {
			foreach($enrollments as $k =>$v) {
				$enrollments[$k]+= $incharge->$k;
			}
		}
		
		return $enrollments;
	}
	public function location() {
		//return AppHelper::location($this->code(), $this->location_latlong);
	}
	
	public function getReportPeriod($term){
		$no = intval(str_replace('REPORT0', '', $term));
		$str = strtotime($this->start_date);
		$m = ($no-1) * 4;
		$start = date('M-Y', strtotime("+$m months", $str));
		$end = date('M-Y', strtotime("+3 months", strtotime($start)));
		//var_dump($start);die();
		return $start. ' to ' . $end;
	}
	
}