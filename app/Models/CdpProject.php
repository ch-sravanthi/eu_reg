<?php 
namespace App\Models;

use App\Models\Project;
use App\Models\Cdp\CdpProjectBudget;
use App\Helpers\AppHelper;
//use App\Auditable;

class CdpProject extends Project{
       
	/*use Auditable;
	protected $budget = null;
	protected $model_title = "CDP Project";
	  */ 
	protected $fillable = [
		'special_project',
		'support',
        'state',
        'district',		
		'start_date',
		'end_date',	
		
		'fcra',
		'project_year',
        'location',
        'location_latlong',
		'class_language',
		'classes',
		'no_of_learners',
		'people_groups',
		'languages',
		'application_status'
	];	
	
	public function rules ()
	{
        return [
			'project_year' => 'required',
			//'special_project' => 'required',
			'state' => 'required',
			'district' => 'required',
            'fcra' => 'required',
			
			'location' => 'required',
			'location_latlong' => 'required',
			'class_language' => 'required',
			'people_groups' => 'required',
			'languages' => 'required',
			'classes' => 'required|numeric',
			'no_of_learners' => 'numeric|required_if:special_project,Y',
        ];
	}
    
	public function niceNames()
    {
        return [
			'amount' => 'Amount',
			'project_year' => 'Project Year',
			'admin' => 'Admin',
        	'stages' => 'Stages',
			'project_code' => 'Project Code',
			'support' => 'Support',
			'special_project' => 'Special Project Type',
			'entity' => 'Entity',
			'zone' => 'Zone',
			'state' => 'State',
			'district' => 'District',
			'status' => 'Approval Status',
			'application_status' => 'Application Status',
			'mi' => 'Prism',
			'fcra' => 'FCRA',
			'swift_code' => 'Swift Code',
			
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
            'location' => 'Location where project would be conducted',
            'location_latlong' => 'Location Latitude & Longitude',
			'class_language' => 'Language(in which class would be conducted)',
            'people_groups' => 'People Groups Lived in this Location',
            'languages' => 'People Language(s) in this Area',
            'classes' => 'No. of Centers',			
			'no_of_learners' => 'No. of Learners per Center',
			
			'project_details' => 'Project Details',
			'project_location_label' => 'Project Location',
			'other_details_label' => 'Other Details',
        ];
    }

	/**
     * Relationship Program Request
     */
    public function program_request()
    {
        return $this->belongsTo('App\Models\CdpProgramRequest', 'program_req_id');
    }
	    
	/**
     * Relationship Project Incharges
     */
	public function project_incharges()
    {
        return $this->hasMany('App\Models\CdpProjectIncharge', 'project_id');
    }
	
	/**
     * Relationship Center Incharges
     */
	public function center_incharges()
    {
        return $this->hasMany('App\Models\CdpCenterIncharge', 'project_id');
    }
	/**
     * Relationship CDP Area Survey
     */
	public function cdp_areasurvey()
    {
        return $this->hasOne('App\Models\CdpAreasurvey', 'project_id');
    }		
	
	/**
     * Relationship CDP Project Status
     */
	public function project_statuses() {
        return $this->hasMany('App\Models\CdpProjectStatus', 'project_id');
	}	
	
	/**
     * Relationship Project Status
     */
	public function project_application_statuses() {
        return $this->hasMany('App\Models\CdpProjectApplicationStatus', 'project_id');
	}
	
	/**
     * Relationship CDP Reports
     */
	public function cdp_reports()
    {
        return $this->hasMany('App\Models\CdpReport', 'project_id');
    }
	
	  public function cdp_actual_report()
    {
        return $this->hasOne('App\Models\CdpActualReport', 'project_id');
    }
	
	/**
     * Relationship Cdp Field Visit Dates
     */
	public function cdp_project_visits()
    {
        return $this->hasMany('App\Models\CdpProjectVisit', 'project_id');
    }
	
	/**
     * Relationship Log
     
    public function logs()
    {
        return $this->hasMany('App\Models\Cdp\Log\CdpProjectLog', 'parent_id');
    }
	*/
	/**
     * Relationship Fop Program
     */
    public function participant()
    {
        return $this->hasOne('App\Models\CdpFopParticipant', 'project_id');
    }
		
	/**
     * Relationship Approval Record
     */
    public function approval_record()
    {
        return $this->hasOne('App\Models\CdpProjectApprovalRecord', 'project_id');
    }
	
	/**
     * Relationship Project Visits
     */
	public function project_visits()
    {
        return $this->hasMany('App\Models\CdpProjectVisit', 'project_id');
    }
	
	// Relation Assigned Staff
	public function assigned_staffs()    {
        return $this->hasMany('App\Models\CdpAssignedStaff', 'project_id');
    }
	
	/**
     * Relationship Project bills
     */
	public function project_bills()
    {
        return $this->hasMany('App\Models\CdpProjectPartnerBill', 'project_id');
    }
	
	/**
     * Relationship Inauguration
     */
    public function inauguration_report()
    {
        return $this->hasOne('App\Models\CdpInaugurationReport', 'project_id');
    }
	
	/**
     * Relationship Preinvestigation Report
     */
    public function preinvestigation()
    {
        return $this->hasOne('App\Models\CdpPreinvestigation', 'project_id');
    }
	
	/**
     * Relationship HEP Report
     */
    public function hep_initial_report()
    {
        return $this->hasOne('App\Models\CdpHepInitialReport', 'project_id');
	}
	
	/**
     * Relationship 1st Follow up HEP Report
     */
    public function first_hep_follow_up_report()
    {
        return $this->hasOne('App\Models\CdpFirstHepFollowUpReport', 'project_id');
	}
	
	/**
     * Relationship Valedictory Report
     */
    public function valedictory_report()
    {
        return $this->hasOne('App\Models\CdpValedictoryReport', 'project_id');
    }
	
	/**
     * Relationship SHTP Report
     */
    public function shtp_report()
    {
        return $this->hasOne('App\Models\CdpShtpReport', 'project_id');
    }
	
	/**
     * Relationship IA Visits
     */
	public function ia_visits()
    {
        return $this->hasMany('App\Models\IaCdp', 'project_id');
    }
	
	public function mof_project()
    {
        return $this->hasOne('App\Models\CdpMofProject', 'project_id');
    }
	
	protected static function boot()
    {
		parent::boot();
       
		static::saving(function ($model) {			
			if (!in_array($model->special_project,['Y', 'Z'])
				|| !$model->no_of_learners) {
				$model->no_of_learners = 30;
			}
			$model->no_of_learners = min(30, $model->no_of_learners);
        });
    }
	
	/*public function hasCompletedBasic() {
		if (!$this->hasCompletedProgramRequest()) {
			return false;
		}
		$project_incharge = $this->project_incharge();
		return ($this->organization && $this->organization->hasCompleted($this->fcra))
			&& ($project_incharge && $project_incharge->hasCompleted($this->fcra))
			&& $this->areasurvey;
			
	}*/
	
	public function newCode() {
		$codes_initial = AppHelper::options('codes_initial');
		$starting = $codes_initial['cdp'];
		return $starting + $this::whereNotNull('project_code')->count() + 1;
		return strtoupper($code);
	}
	
	public function newProjectCode($newCode) {
		$classes = intval($this->classes);
		$classes = ($classes < 10) ? '0'.$classes : $classes;
		$code = $this->project_year. "-" 
		      . $newCode . "-" 
			  . AppHelper::dropdown($this->zone, 'zone_shortcodes') . "-" 
			  . $this->state . "-" 
			  . $this->district . "-" 
			  . $this->entity . "-"
			  . $classes;
		if ($this->special_project != 'R') {
			$code.= '-'.$this->special_project;
		}
		return strtoupper($code);
	}
	
	public function newCenterCode() {
		$newCode = $this->center_incharges->where('code','<>', null)->count() + 1;
		return $this->project_code . '-A' . $newCode;
	}
	
	public function centers() {
		return $this->classes;
	}
	
	public function learners() {
		return $this->classes * $this->no_of_learners;
	}
	
	public function budget() {
		if ($this->budget === null) {
			$budget = CdpProjectBudget::where('project_year', $this->project_year)->first();		
			$budget->records()->where('centers', $this->centers())->first();
		}
		
		return $this->budget;
	}
	
	public function location() {
		return AppHelper::location($this->code(), $this->special_project, $this->location_latlong);
	}
	
	public function billsRequired($category) {
		return !in_array($category, ['honorarium']);
	}
	
	public function centerLocations()
	{
		return implode(',' ,$this->center_incharges()->pluck('location'));		
	}
	/**
     * Relationship 
     */
    public function donations()
    {
        return $this->hasMany('App\Models\CdpDonation', 'project_id');
    }
	public function getReportPeriod($term){
		$no = intval(str_replace('REPORT0', '', $term));
		$str = strtotime($this->start_date);
		$m = ($no-1) * 4;
		$start = date('d-M-Y', strtotime("+$m months", $str));
		$end = date('d-M-Y', strtotime("+4 months", strtotime($start))-1);
		return $start. ' <br> ' . $end;
	}
	
	
}
