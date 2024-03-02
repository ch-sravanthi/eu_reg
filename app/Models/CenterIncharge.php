<?php
namespace App\Models;

use App\Helpers\AppHelper;
use App\Models\Beneficiary;
use App\Models\Person;
use Auth;
use App\Helpers\BudgetPaymentHelper;

abstract class CenterIncharge extends Beneficiary{

	protected $appends = [
		'full_code',
	];	

	public function rules()
	{
		$person =  new Person;
		$bank_account = new BankAccount;
		return  array_merge(
					$person->rules(),
					$bank_account->rules(),
					[
						'dec_copy' => 'nullable|mimes:jpg,jpeg,png,pdf|min:30kb|max:10000',
						'email' => 'nullable|email'
					],
					
					$this->thisRules()
				);
	}
	
	

	public function thisRules()
	{
		return [];
	}

	public function niceNames()
    {
        return [

			'status' => 'Status',
			'photo' => 'Photo',
			'address_proof_copy' => 'Address Proof Copy',
			'dec_copy' => 'Declaration copy'

        ];
    }

	public function dropDownNames()
	{
		return[
			'zone' => 'zones',
			'state' => 'states',
			'gender' => 'gender',
			'status' => 'center_status',
		];
	}


	public function anySearchNames()
	{
		return[
			'project_code',
			'code',
			'zone',
			'gender',
			'state',
			'full_name',
		];
	}

	public function searchNames()
	{
		return[
			'project_code',
			'code',
			'zone',
			'state',
			'full_name',
			'gender',
			'status',
		];
	}

	public function relatedNames()
	{
		return[
				'full_name' => 'person,full_name',
				'gender' => 'person,gender',
				'project_code' => 'project,project_code',
				'zone' => 'project,zone',
				'state' => 'project,state',
		];
	}

	abstract public function project();

	protected static function boot()
    {
		parent::boot();
        static::saving(function ($model) { 
			if (Auth::user()->can('create_center_code', [$model->project, $model])) { 
				$model->code = ($model->name() == 'llt_center_incharge') ? $model->leap_batch->addCenterCodes()  : $model->project->newCenterCode();
			}
			if ($model->mi) {
				$model->sf = $model->mi;
			}
		});

		/*static::updated(function ($model) {
			if ($model->project->application_status == 'mi') {
				$model->project->application_status = 'sync';
				$model->project->save();
			}
        });*/
    }

    public function files()
    {
        return [
			'photo',
			'address_proof_copy',
			'testimony_copy',
            'dec_copy',
        ];
    }

	public function hasCompleted($project = null) {
		$isBasic = (in_array($project->special_project, ['Y', 'Z']));

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
		return !empty($this->person && $this->person->hasCompleted());
	}

	public function nextStages() {

		$workflow_stages = AppHelper::options('center_workflow_stages');
		$stages = [];
		if (isset($workflow_stages[$this->status])) {
			if (Auth::user()->id == $this->created_by
					 && in_array($this->status, ['entry', 'sc_need_clarifications'])
					 && ( Auth::user()->hasAnyRole(['sc', 'zoe']) || Auth::user()->hasAnyState(['mz', 'ar']) )) {
				$stages = $workflow_stages['reviewed_proposal_by_dc']['stages'];
			} elseif (Auth::user()->hasAnyRole($workflow_stages[$this->status]['roles'])) {
				$stages =$workflow_stages[$this->status]['stages'];
			}
		}
		if (Auth::user()->can('withheld', $this)) {
			$stages['withheld'] = 'Withheld';
		}

		return $stages;
	}

	public function route(){
		return route('center_incharge.view', [$this->name(), $this->id]);
	}

	public function incharge_name(){
		return $this->person->fullname();
	}

	public function type() {
		return 'center_incharge';
	}

	public function getFullCodeAttribute() {
		return  $this->code;
	}

	public function getIctFullCodeAttribute() {			
		return  $this->code ? $this->project->project_code.'-'.$this->code : null;
	}
	

	public function declaration() {
		if ($this->declaration_copy) {
			return PersonFile::find($this->declaration_copy);
		}
	}

	public function getId() {
		$project_code = $this->project->code();
		if ($this->code) {
			return ($this->name() == 'ict_project_incharge') ? $project_code . '-'.$this->code : $this->code;
		}
		return $project_code.'-Center';
	}


	public function isValid($project, $person, $add = true) {

		$project_year = $project->project_year;
		$incharges = $person->inchargeByYear($project_year, false);

		$limit = ($add) ? 0 : 1;

		$hasExceeded = count($incharges) > $limit;
		return $hasExceeded ? false : true;
	}

	public function isActive() {
        return !in_array($this->status, ['inactive']);
	}

	public function createPayments(&$project) {
		$budget = BudgetPaymentHelper::budget($project);
		if ($project->entity == 'LH'
  		 || $project->isFcra()
		 || !$this->isActive()
		 || !$budget) {
			return;
		}

		if ($this->parent && $this->parent->payments()->whereNotIn('term', ['ttp', 'ltp', 'pop', 'orp', 'top'])->count() > 0) {
			return;
		}

		$terms = BudgetPaymentHelper::terms($project);
		foreach ($terms as $k => $v) {
			if(in_array($k, ['ttp', 'ltp', 'pop', 'orp', 'top'])) { // ttp should not be added from here
				continue;
			}
			if (!in_array($k, BudgetPaymentHelper::projectInchargePaymentTerms($project))) {
				$this->addPayment($k, 'honorarium', $budget->center_incharge_honorarium);
			}
		}
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

		$payment->project_id = $this->project_id;
		$payment->center_incharge_id = $this->id;
		$payment->save();
		return $payment;
	}

	public function canAddPayment($term, $category) {

		$payment_model = $this->getRelatedModel('payments');

		if ($term == 'ltp') {
			$payment = $payment_model::where('center_incharge_id', $this->id)
					   ->where('term', $term)
					   ->where('category', $category)
					   ->whereNull('indent_id')
					   ->first();
			return ($payment) ? false : true;
		}

		$payment = $payment_model::where('center_incharge_id', $this->id)
					   ->where('term', $term)
					   ->where('category', $category)
					   ->first();

		return ($payment) ? false : true;
	}

	public function indexRoute() {
		return route('center_incharges',[$this->name()]);
	}
}
