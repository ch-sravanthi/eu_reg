<?php
namespace App\Models;

use Auth;
use App\AppModelNew;
use App\Helpers\AppHelper;
use App\Helpers\DataHelper;
use ModelHelper;

abstract class Project extends AppModelNew
{
	//abstract public function program_request();
	
	public function assigned_staff() {
		return $this->belongsTo('App\Models\Employee\Employee', 'staff_id');
	}
	
	public function user() {		
		return $this->belongsTo('App\User', 'created_by');
	}
	
	/**
     * Relationship Organization
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
	
	public function project_incharge() {
		foreach ($this->project_incharges as $project_incharge) {
			if ($project_incharge->isActive()) {
				return $project_incharge;
			}
		}
		
	}
	
	protected static function boot()
    {
		parent::boot();


		static::creating(function ($model) {
			if ($model->name() != 'leap_batch')	{
				$model->special_project = 'R';
			}
		});

		// add project code while saving for approved projects
		static::saving(function ($model) {
			
			if ($model->name() == 'dlc_project' && Auth::user()->can('create_dlc_project_code', $model)) {
				$model->entity = 'SB';
				$model->addCode();				
				$model->addCenterCodes();
			}
			
			
			/*if (Auth::user()->can('create_project_code', $model) && $model->name() != 'leap_batch') {
				$newCode = $model->newCode();
				$model->code = $newCode;
				$model->project_code = $model->newProjectCode($newCode);
			}*/
			$model->zone = AppHelper::getZone($model->state);
        });

		static::updating(function ($model) {
			$model->zone = AppHelper::getZone($model->state);

			$original = $model->getOriginal();

			if ($model->project_code && $model->name() != 'leap_batch') {
				$model->project_code = $model->changedCode();
			}
			if (!in_array($model->name(), ['cdp_ttp_project', 'leap_batch'])) {

				if ($original['project_code'] != $model->project_code) {
					foreach($model->center_incharges as $center_incharge) {
						if (!empty($center_incharge->code)) {
							$center_incharge->code = str_replace($original['project_code'], $model->project_code, $center_incharge->code);
							$center_incharge->save();
						}
					}

				}
				
				foreach ($model->getCenterIncharges() as $i => $center_incharge) {
					if (Auth::user()->can('create_center_code', [$model, $center_incharge]))  {
						$center_incharge->code = $model->newCenterCode();
						$center_incharge->save();
					}
				}
			} elseif (in_array($model->name(), ['leap_batch'])) { 
				//$model->addCodes();
			}
			if ($model->mi) {
				$model->sf = $model->mi;
			}
        });
		static::updated(function ($model) {
			$original = $model->getOriginal();
			if ($model->entity != $original['entity'] && !in_array($model->name(), ['cdp_ttp_project'])) {
				foreach($model->center_incharges()->whereNotNull('code')->get() as $center_incharge) {
					$center_incharge->code = str_replace('-'.$original['entity'].'-', '-'.$model->entity.'-', $center_incharge->code);
					$center_incharge->save();
				}
			}

			// update center review status
			if ($model->application_status != $original['application_status']) {
				foreach ($model->getCenterIncharges() as $i => $center_incharge) {
					if (!in_array($model->application_status, ['mi','rejected_by_mi'])) {
						$center_incharge->review_status = $model->application_status;
						$center_incharge->save();
					}
				}
			}
        });
    }
	
	public function changedCode(){
		$entities = array_keys(AppHelper::options('entities'));
		$project_code_half = AppHelper::multiexplode($entities, $this->project_code);
		if ($this->name() == 'ict_project') {
			$c = '';
		} else {			
			$c = $this->centers();
			$c = '-' . (($c >= 10) ? $c : "0$c");
		}
		$sp = $this->special_project != 'R' ? '-' . $this->special_project : '';
		return $project_code_half[0] . $this->entity . $c . $sp;
	}	
	
	
	public function dbmState()
	{
		$state = AppHelper::dropdown($this->state, 'states');
		$project_year = substr($this->project_year, 0, 6);
		$arr = explode('-',trim($project_year));
		if($arr[0] == 'CDP'){
			$project_year = 'TTP-'.$arr[1];
			return str_replace('-', "-$state'", $project_year);
		}else{
			return str_replace('-', "-$state'", $project_year);
		}
	}
	
	public function dbmZone()
	{
		$state = AppHelper::dropdown($this->zone, 'zones');
		$project_year = substr($this->project_year, 0, 6);
		$arr = explode('-',trim($project_year));
		if($arr[0] == 'CDP'){
			$project_year = 'TTP-'.$arr[1];
			return  str_replace('-', "-$state Zone'", $project_year);
		}else{		
			return str_replace('-', "-$state Zone'", $project_year);
		}
	}
	
	public function route() 
	{
		return route('project.view', [$this->name(), $this->id]);
	}
	
	public function workflow($type) {	
		return ($type == 'status') ? 'project_approval_workflow' : 'application_workflow';		
	}
	
	public function incharge_name() {
		if ($this->organization) {
			return $this->organization->organization_name;
		}
	}
	
	public function code() {//var_dump($this->project_year);
		return ($this->project_code) ? $this->project_code : $this->project_year;
	}	
	
	public function hasCompleted() {
		return $this->hasCompletedBasic() && $this->hasCompletedCenters();
	}
	
	public function hasCompletedBasic() {
		$project_incharge = $this->project_incharge();
		return ($this->organization && $this->organization->hasCompleted($this->fcra))
			&& ($project_incharge && $project_incharge->hasCompleted($this, true));			
	}
	
	public function hasCompletedProjectIncharge(&$project_incharge = null) {
		$project_incharge = $this->project_incharge();		
		if (!$project_incharge) {
			return false;
		}
		return $project_incharge->hasCompleted($this);
		
	}
	
	public function hasCompletedCenters() {
		if ($this->centersAdded() != $this->centers()) {
			return false;
		}
		
		foreach ($this->getCenterIncharges() as $center_incharge) {
			if (!$center_incharge->hasCompleted($this)) {
				return false;
			}
		}
		return true;
	}
	
	// While creating Payments for Project Incharge
	public function hasProjectInchargePayments() {
		foreach ($this->project_incharges as $project_incharge) {
			if ($project_incharge->payments()->count() > 0) {
				return true;
			}
		}
		return false;
	}
	
	public function centersAdded() {
		return $this->center_incharges->whereNotIn('status', ['inactive'])->count();
	}
	
	public function getCenterIncharges() {		
		return $this->center_incharges->whereNotIn('status', ['inactive'])->all();
	}
	
    public function visit_report($plan_id) {
        return $this->project_visits()->where('plan_id', $plan_id)->first();
    }
	
	public function case_histories($plan_id) {
		$case_history_name = str_replace('project', 'case_history', $this->name());
		$case_history = ModelHelper::load($case_history_name);
		return $case_history::where('plan_id', $plan_id)
							->whereIn('center_incharge_id', DataHelper::centerInchargeIds($this))
							->get();
	}
	
	public function fris($plan_id) {
		$fri_name = str_replace('project', 'fri', $this->name());
		$fri = ModelHelper::load($fri_name);
		return $fri::where('plan_id', $plan_id)
							->whereIn('center_incharge_id', DataHelper::centerInchargeIds($this))
							->get();
	}
	
	public function paymentsConsolidated($project_year, $zone = null, $state = null) {
		$report = [];
		$projects = $this->getProjects($project_year, $zone, $state);
		$payments = $this->payments($projects);
		$payment_report_breakup = AppHelper::options('payment_report_breakup');
		
		foreach ($projects as $project) {
			if (!isset($report[$project->state])) {
				$report[$project->state] = $payment_report_breakup;
			}
			
			// projects	
			$report[$project->state]['projects']++;
			
			// partner id
			$organization = $project->organization;
			if ($organization && $organization->partner_id) {
				$report[$project->state]['partner_id']++;
			} else {
				$report[$project->state]['without_partner_id']++;				
			}
			
			// project incharge
			$project_incharge = $project->project_incharge();
			if ($project_incharge) {
				$report[$project->state]['project_incharges']++;
				$bankmaster = $project_incharge->bankmaster();
				if ($bankmaster) {					
					$report[$project->state]['project_incharge_bankmasters']++;
				} else {
					$report[$project->state]['without_project_incharge_bankmasters']++;					
				}
			}
			
			// center incharge
			foreach ($project->getCenterIncharges() as $center_incharge) {
				$report[$project->state]['center_incharges']++;
				$bankmaster = $center_incharge->bankmaster();
				if ($bankmaster) {					
					$report[$project->state]['center_incharge_bankmasters']++;
				} else {
					$report[$project->state]['without_center_incharge_bankmasters']++;					
				}
				
			}
		}
		return $report;
	}
	
	
	public function payments(&$projects) {
		$payments = [];
		foreach($projects as $project) {			
			foreach ($project->project_incharges as $project_incharge) {
				foreach ($project_incharge->payments as $payment) {
					if (!isset($payments[$project->id]['project_incharge'][$payment->term])) {
						$payments[$project->id]['project_incharge'][$payment->term]['payment'] = $payment;
						$payments[$project->id]['project_incharge'][$payment->term]['amount'] = 0;
					}
					$payments[$project->id]['project_incharge'][$payment->term]['amount']+= $payment->amount;
				}
			}
									
			foreach ($project->getCenterIncharges() as $center_incharge) {
				foreach ($center_incharge->payments as $payment) {
					if (!isset($payments[$project->id]['center_incharges'][$center_incharge->id][$payment->term])) {
						$payments[$project->id]['center_incharges'][$center_incharge->id][$payment->term]['payment'] = $payment;
						$payments[$project->id]['center_incharges'][$center_incharge->id][$payment->term]['amount'] = 0;
					}
					$payments[$project->id]['center_incharges'][$center_incharge->id][$payment->term]['amount']+= $payment->amount;
				}
			}
		}
		
		return $payments;
	}
	
	public function getProjects($project_year, $special_project, $zone, $state) {
		$query = $this::query();
		$query->where('status', 'approved');
		$query->when($project_year, function($query, $project_year) {
			$query->where('project_year', 'like', "$project_year%");
		});
		
		$query->when($zone, function($query, $zone) {
			$query->where('zone', $zone);
		});
		
		$query->when($state, function($query, $state) {
			$query->where('state', $state);
		});
		if (!$special_project || empty($special_project)) {		
			$query->where(function($q){
				$q->whereNull('special_project');
				$q->orWhereNotIn('special_project', ['Y', 'Z']);
			});
		} else {
			$query->where('special_project', $special_project);
		}
		
		$query->orderBy('zone', 'state', 'project_code');
		
		return $query->get();
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
								->find($id);
	}
	
    /**
     * Check if project is FCRA.
     *
     * @return boolean
     */
	public function isFcra() {
		return $this->fcra == 'yes';
	}
	
	public function program() {
		$exp = explode('_', $this->name());
		return $exp[0];
	}
	
	public function department() {
		$exp = explode('_', $this->name());
		return ($exp[0] == 'asc') ? 'cdp' : $exp[0];
	}
	
	public function projectYearOptions() {
		$exp = str_replace('_project', '', $this->name());
		return AppHelper::options($exp.'_project_years');
	}
}
