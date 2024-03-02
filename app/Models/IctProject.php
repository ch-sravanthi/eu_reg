<?php 
namespace App\Models;

use App\Models\Project;
use App\Models\IctCenterIncharge;
use App\Helpers\AppHelper;
use App\Auditable;
use App\Helpers\IctHelper;

class IctProject extends Project{
       
	protected $model_title = "ICT Project";
	   
	protected $fillable = [
		'special_project',
        'state',
        'district',		
		'start_date',
		'end_date',
		'intrest',
        'impact', 
		'fcra',
		'project_year',
		'districts',
		'district_strategy',	
        'taluk_name',
        'people_groups',
		'people_religions',
		'languages',
		'class_language',
		'denominations',
		'christians_percentage',
		'untrained_students',
		'project_attachment',
		'application_status',
		'attachment',
		'entity'
	];	
	
	public function rules ()
	{
        return [
			'state' => 'required',
			'district' => 'required',
			'people_groups' => 'required',
			'languages' => 'required',
			'impact' => 'required',
			'intrest' => 'required',
			'class_language' => 'required',
        ];
	}
    
	public function niceNames()
    {
        return [
			'project_year' => 'Project Year',
			'admin' => 'Admin',
			'project_code' => 'Project Code',
			'special_project' => 'Project Type',
			'entity' => 'Entity',
			'zone' => 'Zone',
			'state' => 'State',
			'district' => 'District',
			'district_strategy' => 'District Strategy',
			'status' => 'Status',
			'application_status' => 'Application Status',
			'mi' => 'Prism',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'fcra' => 'FCRA',
			'swift_code' => 'Swift Code',
            'districts' => 'Name of the District(s) adopted for Community Transformation',
            'taluk_name' => 'Name of the Taluks/Mandals which will be reached',
            'people_groups' => 'People Groups Lived in this Location',
            'people_religions' => 'People Religion(s) in this Area',
            'languages' => 'People Language(s) in this Area',
            'class_language' => 'Language (in which class would be conducted)',
            'denominations' => 'What denomination Churches are existing in this area',
            'christians_percentage' => 'Christian Percentage(%) in this area',
            'untrained_students' => 'Untrained Students in this Area',
			'attachment' => 'Students Interview Sheet Attachment',
			'project_details' => 'Project Details',
			'project_details_label' => 'Project Details',
			'project_location_label' => 'Project Location',
			'other_details_label' => 'Other Details',
			'program_request_label' => 'Program Request',
			'project_attachment' => 'Tutors Interview Sheet Attachment',
			'organization_name' => 'Organization Name',
			'organization_head' => 'Organization Head',
			'full_name' => 'Facilitator',
			'staff_id' => 'Assigned Staff',
			'intrest' => 'Why are you intrested in this program',
            'impact' => 'How are you going to Impact Society',
        ];
    }
	
	
	/**
     * Relationship Program Request
     */
    public function program_request()
    {
        return $this->belongsTo('App\Models\IctProgramRequest', 'program_req_id');
    }
	    
	/**
     * Relationship Project Incharges
     */
	public function project_incharges()
    {
        return $this->hasMany('App\Models\IctProjectIncharge', 'project_id');
    }
	
	/* Relationship Center Incharges*/
	
	public function center_incharges()
    {
        return $this->hasMany('App\Models\IctCenterIncharge', 'project_id');
    }
	
	/**
     * Relationship Tutors
     */
	public function ict_tutors()
    {
        return $this->hasMany('App\Models\IctTutor', 'project_id');
    }
	
	/**
     * Relationship Project Status
     */
	public function project_statuses() {
        return $this->hasMany('App\Models\IctProjectStatus', 'project_id');
	}	
	
	/**
     * Relationship Project Status
     */
	public function project_application_statuses() {
        return $this->hasMany('App\Models\IctProjectApplicationStatus', 'project_id');
	}
	
	/**
     * Relationship Log
     
    public function logs()
    {
        return $this->hasMany('App\Models\Log\IctProjectLog', 'parent_id');
    }*/
	
	/**
     * Relationship ICT Actuals
     */	
	public function ict_actual_report()
    {
        return $this->hasOne('App\Models\IctActualReport', 'project_id');
    }
		
	/**
     * Relationship Approval Record
     */
    public function approval_record()
    {
        return $this->hasOne('App\Models\IctProjectApprovalRecord', 'project_id');
    }
	
	
	/**
     * Relationship Project Visits
     */
	public function project_visits()
    {
        return $this->hasMany('App\Models\IctProjectVisit', 'project_id');
    }
	
	/**
     * Relationship Inauguration
     */
    public function inauguration_report()
    {
        return $this->hasOne('App\Models\IctInaugurationReport', 'project_id');
    }
	
	
	/**
     * Relationship Preinvestigation Report
     */
    public function preinvestigation()
    {
        return $this->hasOne('App\Models\IctPreinvestigation', 'project_id');
    }
	
	/**
     * Relationship HEP
     */
    public function hep_initial_report()
    {
        return $this->hasOne('App\Models\IctHepInitialReport', 'project_id');
    }
	 public function first_hep_follow_up_report()
    {
        return $this->hasOne('App\Models\IctFirstHepFollowUpReport', 'project_id');
    }
	
	/**
     * Relationship Fop Program
     */
    public function participant()
    {
        return $this->hasOne('App\Models\IctFopParticipant', 'project_id');
    }
	
	/**
     * Relationship IA Visits
     */
	public function ia_visits()
    {
        return $this->hasMany('App\Models\IaIct', 'project_id');
    }
	
	public function ict_project_reports()
    {
        return $this->hasMany('App\Models\IctProjectReport', 'project_id');
    }
	
	
	/**
     * Relationship Project bills
     */
	public function project_bills()
    {
        return $this->hasMany('App\Models\IctProjectPartnerBill', 'project_id');
    }
	
	// Relation Assigned Staff
	public function assigned_staffs()    {
        return $this->hasMany('App\Models\IctAssignedStaff', 'project_id');
    }
	
	public function relations() {
		return [
			'active_project_incharge' => ['belongsTo', IctProjectIncharge::class],
			'center_incharges' => ['hasMany', IctCenterIncharge::class],
			'ict_tutors' => ['hasMany', IctTutor::class],
		];		
	}
	public function getViewOptions(){
		return "ict.ict_project.options";
	}
	
	public function newCode() {
		$codes_initial = AppHelper::options('codes_initial');
		$starting = $codes_initial['ict'];
		return $starting + $this::whereNotNull('project_code')->count() + 1;
	}	
	
	public function newProjectCode($newCode) {
		$code = $this->project_year . "-" 
		      . $newCode . "-" 
			  . AppHelper::dropdown($this->zone, 'zone_shortcodes') . "-" 
			  . $this->state . "-" 
			  . $this->district . "-" 
			  . $this->entity;
		  
		if ($this->special_project != 'R') {
			$code.= '-'.$this->special_project;
		}
		return strtoupper($code);
	}
	
	public function newCenterCode() {
		$start_code = $this->approval_record->start_code;
		$end_code = $this->approval_record->end_code;
		$alreadyGiven = $this->center_incharges()->whereNotNull('code')->count();
		if ($start_code) {
			if ($alreadyGiven < 10) {
				return $start_code + $alreadyGiven;
			} else {
				return IctHelper::nextStudentCode();
			}
		}
	}
	
	public function centers() {
		return 10;
	}
	
	
	public function location() {
		$center_incharge = $this->center_incharges()->first();
		if ($center_incharge) {
			return AppHelper::location($this->code(), $this->special_project, $center_incharge->location_1_latlong);
		}
	}
	
	public function billsRequired($category) {
		return !in_array($category, ['honorarium']);
	}
	
	public function mi() {
		$miIctHelper = new IctHelper();
		$miPartnerHelper = new PartnerHelper();
		
		$rganization = $this->organization;
		$id = $miPartnerHelper->move($rganization,  $rganization->fcra);
		$rganization->mi = $id;
		$rganization->save();
		
		$id = $miIctHelper->move($this);
		$this->mi = $id;
		$this->save();
		foreach ($this->center_incharges as $center_incharge) {
			$id = $miIctHelper->moveStudent($center_incharge);
			$center_incharge->mi = $id;
			$center_incharge->save();
			//$miIctHelper->uploadStudentPic($center_incharge);
			break;
		}
		
		$url = $miIctHelper->link($project->mi);
		//return redirect()->back()->with(['success' => "Moved to Prism Successfully. <a href='$url'>Click here to  view</a>"]);
	}
	
	public function getProjectById($id) {
		return $this::with('organization')
		                        ->with(['project_incharges' => function($query) {
									$query->with(['person' => function($query) {
										$query->with(['bank_accounts']);
									}]);
								}])
								->with(['center_incharges' => function($query) {
									$query->with(['person' => function($query) {
										$query->with(['bank_accounts']);
									}]);
								}])
		                        ->with(['ict_tutors'])
								->find($id);
	}
	public function getReportPeriod($term){
		$no = intval(str_replace('REPORT0', '', $term));
		$str = strtotime($this->start_date);
		$m = ($no-1) * 4;
		$start = date('d-M-Y', strtotime("+$m months", $str));
		$end = date('d-M-Y', strtotime("+4 months", strtotime($start))-1);
		return $start. ' <br> ' . $end;
	}
	
	public function code() {
		return $this->project_code;
	}
	
	public function hasRequiredCenters(){	
		if($this->center_incharges)	{
			return 13;
		}else{
			return 7;
		}
	}
	
	public function canSubmit(){		
		return  count($this->center_incharges) ==  $this->hasRequiredCenters() && count($this->ict_tutors) == 7;
	}
	
	public function requirements(){	
		$req[] = 'You have entered '.count($this->center_incharges).' Students, Minimum 13 required';
		$req[] = 'You have entered '.count($this->ict_tutors).' Tutors, Minimum 7 required';
		return $req;
	}
}