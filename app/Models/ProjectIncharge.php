<?php 
namespace App\Models;

use App\Models\Beneficiary;
use App\Models\Person;
use App\Models\PersonFile;
use Auth;
use App\Helpers\BudgetPaymentHelper;

abstract class ProjectIncharge extends Beneficiary{
       
	public function rules()
	{
		$person =  new Person;
		$bank_account = new BankAccount;
		return  array_merge(
					$person->rules(),
					$bank_account->rules(),
							[			
								'dec_copy' => 'nullable|mimes:jpg,jpeg,png,pdf|max:1024',
							]);
	}
	
	public function thisRules()
	{
		return  [];
	}
	
	public function niceNames()
    {
		
		$person =  new Person;
		$bank_account =  new BankAccount;
		return  array_merge($person->niceNames(), 
							$bank_account->niceNames(),
							 [
						'ict_osr' => 'Programs',
						'alttp' => 'Programs',
						'asc_ltp' => 'Programs',
						'cbc_pop' => 'Programs',
						'status' => 'Status',
						'photo' => 'Photo',
						'address_proof_copy' => 'Address Proof Copy',
						'testimony_copy' => 'Testimony Copy',
						'dec_copy' => 'Declaration Copy',			
						'application_copy' => 'Profile Copy',
					]
				);
    }

    abstract public function project();
	
    public function files()
    {
        return [        
			'photo',
			'address_proof_copy',
			'testimony_copy',
            'dec_copy',
        ];
    }	
	
	protected static function boot()
    {
		parent::boot();
		
        static::creating(function ($model) {
			$project = $model->project;			
			
			if (!request()->duplicate) {
				// make old project incharge inactive
				foreach ($project->project_incharges()->where('status', 'active')->get() as $old_project_incharge) {
					if ($project->status != 'approved') {				
						$old_project_incharge->delete();
					} else {
						$old_project_incharge->status = 'inactive';
						$old_project_incharge->save();
					}
				}	
			}			
		});
    }
	
	public function hasCompleted(&$project, $isBasic = false) {
		// basic is dec copy and person(without bank_account)
		//  
		$basic = ($this->person && $this->person->hasCompleted());
		if ($isBasic) {
			return $basic;
		} elseif($project->isFcra()) {
			return !empty($this->dec_copy) && $basic;
		} else {
			return !empty($this->dec_copy) && $basic && $this->person->bank_account();
		}
	}
	
	public function hasRequiredFiles() {		
		return !empty($this->dec_copy) && ($this->person && $this->person->hasCompleted());		
	}	
	
	public function code() {	
		return $this->project->project_code;
	}
	public function route(){
		if(!$this->project) return;	
		return route("project_incharge.view", [$this->project->name(), $this->project->id, $this->id]);		
	}
	
	public function type() {
		return 'project_incharge';
	}
		
	public function addPayment($term, $category, $amount) {
		if (!$this->canAddPayment($term, $category) || !$amount) {
			return;
		}	
		$payment_model = $this->getRelatedModel('payments');
		$payment = new $payment_model;
		$payment->term = $term;
		$payment->category = $category;
		$payment->amount = $amount;
		$payment->bills_required = $this->project->billsRequired($category);
		$this->payments()->save($payment);
	}
	
	public function canAddPayment($term, $category) {
		
		$payment_model = $this->getRelatedModel('payments');
		$projectInchargeIds = $this->project->project_incharges()->pluck('id');
		
		$payment = $payment_model::whereIn('project_incharge_id', $projectInchargeIds)
					   ->where('term', $term)
					   ->where('category', $category)
					   ->first();
					   
		return ($payment) ? false : true;
	}	

	
	public function getId() {
		return $this->project->code();
	}
	
	
	/** 
	 * -- deprecate it
	 * Check if Project Incharge can be added(is valid)
	 * 
	 */
	public function isValid($project, $person, $add = true) {
        
		$project_year = $project->project_year;		
		$address_proof_id = $person->address_proof_id;
		$incharges = $person->inchargeByYear($project_year, true);
		
		$limit = ($add) ? 0 : 1;
		
		$hasExceeded = count($incharges) > $limit;
		
		// if project is semi support, check if incharge is taken same program, only if not then it is invalid
		if ($hasExceeded && $project->special_project == 'Y') {
			foreach ($incharges as $incharge) {
				if ($incharge->project->name() != $project->name()) {
					return $hasExceeded;
				}
			}
			return false;
		}	
						
		return $hasExceeded ? false : true;
	}
	
	public function isActive() {
        return !in_array($this->status, ['inactive']);
	}
	
	public function createPayments(&$project, $create = true) { 
		$budget = BudgetPaymentHelper::budget($project);
		if (!$budget && $project->special_project != 'Y') {
			return;
		}
		if ($create) { // for creation payments should not exist
			if ($project->hasProjectInchargePayments()) {
				return;
			}
		} else { // for update atleast one payment should exist
			if (!$project->hasProjectInchargePayments()) {
				return;
			}
		}
		// for semi support
		if ($project->special_project == 'Y') { 
			foreach(['shtp', 'val'] as $k) {
				$this->addPayment($k, $k, BudgetPaymentHelper::alSpecialProjectAmount($k, $project->learners()));
			}
			return;
		}
		$terms = BudgetPaymentHelper::terms($project);
		foreach ($terms as $k => $v) {	
			if (in_array($k, BudgetPaymentHelper::projectInchargePaymentTerms($project))) {
				$this->addPayment($k, $k, $budget->$k);	
				
			} else {
				// facilitator honorarium
				$honorarium = ($project->entity == 'LH') ? ($budget->project_incharge_honorarium + ($project->centers() * $budget->center_incharge_honorarium)) : $budget->project_incharge_honorarium;
				
				$this->addPayment($k, 'honorarium', $honorarium);
				
				// special customization for ict
				if ($project->name() == 'ict_project') {					
					// residential amount
					if (in_array($k, ['1r', '2r', '3r'])) {
						$this->addPayment($k, 'food', $budget->food);				
						$this->addPayment($k, 'tutor_honorarium', $budget->tutor_honorarium);	
					}	
				}
			}
		}
	}
	
	public function billsAmount($term) {
		return $this->payments->where('term', $term)->where('bills_required', 1)->sum('amount');
	}
}


