<?php 
namespace App\Models;

use App\Models\Project;
use App\Models\Al\AlProjectBudget;
use App\Helpers\AppHelper;
//use App\Auditable;

class AlProject extends Project{
       
	/*use Auditable;
	protected $budget = null;
	protected $model_title = "AL Project";
	  */ 
	protected $fillable = [
		'special_project',
		'support',
        'state',
        'district',		
		'start_date',
		'end_date',	
		
		'fcra',
		'intrest',
        'impact', 
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
			
			'state' => 'required',
			'district' => 'required',
			
			'class_language' => 'required',
			'people_groups' => 'required',
			'languages' => 'required',
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
			'intrest' => 'Why are you intrested in this program',
            'impact' => 'How are you going to Impact Society',
        ];
    }

	/**
     * Relationship Program Request
     */
    public function program_request()
    {
        return $this->belongsTo('App\Models\AlProgramRequest', 'program_req_id');
    }
	    
	/**
     * Relationship Project Incharges
     */
	public function project_incharges()
    {
        return $this->hasMany('App\Models\AlProjectIncharge', 'project_id');
    }
	
	/**
     * Relationship Center Incharges
     */
	public function center_incharges()
    {
        return $this->hasMany('App\Models\AlCenterIncharge', 'project_id');
    }
	/**
     * Relationship AL Area Survey
     */
	public function al_areasurvey()
    {
        return $this->hasOne('App\Models\AlAreasurvey', 'project_id');
    }		
	
	/**
     * Relationship AL Project Status
     */
	public function project_statuses() {
        return $this->hasMany('App\Models\AlProjectStatus', 'project_id');
	}	
	
	/**
     * Relationship Project Status
     */
	public function project_application_statuses() {
        return $this->hasMany('App\Models\AlProjectApplicationStatus', 'project_id');
	}
	
	/**
     * Relationship AL Reports
     */
	public function al_reports()
    {
        return $this->hasMany('App\Models\AlReport', 'project_id');
    }
	
	  public function al_actual_report()
    {
        return $this->hasOne('App\Models\AlActualReport', 'project_id');
    }
	
	/**
     * Relationship Al Field Visit Dates
     */
	public function al_project_visits()
    {
        return $this->hasMany('App\Models\AlProjectVisit', 'project_id');
    }
	
	/**
     * Relationship Log
     
    public function logs()
    {
        return $this->hasMany('App\Models\Al\Log\AlProjectLog', 'parent_id');
    }
	*/
	/**
     * Relationship Fop Program
     */
    public function participant()
    {
        return $this->hasOne('App\Models\AlFopParticipant', 'project_id');
    }
		
	/**
     * Relationship Approval Record
     */
    public function approval_record()
    {
        return $this->hasOne('App\Models\AlProjectApprovalRecord', 'project_id');
    }
	
	/**
     * Relationship Project Visits
     */
	public function project_visits()
    {
        return $this->hasMany('App\Models\AlProjectVisit', 'project_id');
    }
	
	// Relation Assigned Staff
	public function assigned_staffs()    {
        return $this->hasMany('App\Models\AlAssignedStaff', 'project_id');
    }
	
	/**
     * Relationship Project bills
     */
	public function project_bills()
    {
        return $this->hasMany('App\Models\AlProjectPartnerBill', 'project_id');
    }
	
	/**
     * Relationship Inauguration
     */
    public function inauguration_report()
    {
        return $this->hasOne('App\Models\AlInaugurationReport', 'project_id');
    }
	
	/**
     * Relationship Preinvestigation Report
     */
    public function preinvestigation()
    {
        return $this->hasOne('App\Models\AlPreinvestigation', 'project_id');
    }
	
	/**
     * Relationship HEP Report
     */
    public function hep_initial_report()
    {
        return $this->hasOne('App\Models\AlHepInitialReport', 'project_id');
	}
	
	/**
     * Relationship 1st Follow up HEP Report
     */
    public function first_hep_follow_up_report()
    {
        return $this->hasOne('App\Models\AlFirstHepFollowUpReport', 'project_id');
	}
	
	/**
     * Relationship Valedictory Report
     */
    public function valedictory_report()
    {
        return $this->hasOne('App\Models\AlValedictoryReport', 'project_id');
    }
	
	/**
     * Relationship SHTP Report
     */
    public function shtp_report()
    {
        return $this->hasOne('App\Models\AlShtpReport', 'project_id');
    }
	
	/**
     * Relationship IA Visits
     */
	public function ia_visits()
    {
        return $this->hasMany('App\Models\IaAl', 'project_id');
    }
	
	public function mof_project()
    {
        return $this->hasOne('App\Models\AlMofProject', 'project_id');
    }
	
	public function relations() {
		return [
			'organization' => ['belongsTo', Organization::class],
			'active_project_incharge' => ['belongsTo', AlProjectIncharge::class],
			'center_incharges' => ['hasMany', AlCenterIncharge::class],
		];		
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
		$starting = $codes_initial['al'];
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
			$budget = AlProjectBudget::where('project_year', $this->project_year)->first();		
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
        return $this->hasMany('App\Models\AlDonation', 'project_id');
    }
	public function getReportPeriod($term){
		$no = intval(str_replace('REPORT0', '', $term));
		$str = strtotime($this->start_date);
		$m = ($no-1) * 4;
		$start = date('d-M-Y', strtotime("+$m months", $str));
		$end = date('d-M-Y', strtotime("+4 months", strtotime($start))-1);
		return $start. ' <br> ' . $end;
	}
	
	public function hasRequiredCenters(){		
		return  '8';
	}
	public function canSubmit(){	

		return  count($this->center_incharges) ==  $this->hasRequiredCenters();
	}
	public function requirements(){	
		$req[] = 'You have entered '.count($this->center_incharges).' Assistants, Minimum 8 required';
		return $req;
	}
}
