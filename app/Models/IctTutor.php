<?php 
namespace App\Models;

use App\AppModel;
use App\Models\IctProject;
use App\Models\Person;
use Auth;
use App\Helpers\AppHelper;
use App\Models\Beneficiary;
use App\Helpers\BudgetPaymentHelper;

class IctTutor extends Beneficiary{
	
	public $fillable = [
		'denomination',
		'theological_qualification',
		
		'language_1',
		'read_1',
		'write_1',
		'speak_1',
		
		'language_2',
		'read_2',
		'write_2',
		'speak_2',
		
		'language_3',
		'read_3',
		'write_3',
		'speak_3',
		
		'edu_institution_1',
        'degree_1',	
        'degree_from_1',	
        'degree_to_1',
		
		'edu_institution_2',
        'degree_2',	
        'degree_from_2',	
        'degree_to_2',
		
		'edu_institution_3',
        'degree_3',	
        'degree_from_3',	
        'degree_to_3',
		'code'
	];

	public function rules()
	{
		$person =  new Person;
		$person_rules = $person->rules();
		$person_rules['email'] = 'nullable|email';
		//$person_rules['previous_exp'] = 'nullable';
		//$person_rules['min_exp'] = 'required';
				
		return array_merge($person_rules, $this->thisRules());
	}
	
	public function thisRules()
	{
		return  [
			'denomination' => 'nullable',
			'theological_qualification' => 'nullable',
			
			'language_1' => 'required',
			'read_1' => 'required',
			'write_1' => 'required',
			'speak_1' => 'required',
			
			'language_2' => 'nullable',
			'read_2' => 'required_with:language_2',
			'write_2' => 'required_with:language_2',
			'speak_2' => 'required_with:language_2',
			
			'language_3' => 'nullable',
			'read_3' => 'required_with:language_3',
			'write_3' => 'required_with:language_3',
			'speak_3' => 'required_with:language_3',
			
			'edu_institution_1' => 'nullable',
			'degree_1' => 'nullable',	
			'degree_from_1' => 'nullable',	
			'degree_to_1' => 'nullable|after_or_equal:degree_from_1',
			
			'edu_institution_2' => 'nullable',
			'degree_2' => 'required_with:edu_institution_2',	
			'degree_from_2' => 'required_with:edu_institution_2',	
			'degree_to_2' => 'nullable|required_with:edu_institution_2|after_or_equal:degree_from_2',
			
			'edu_institution_3' => 'nullable',
			'degree_3' => 'required_with:edu_institution_3',	
			'degree_from_3' => 'required_with:edu_institution_3',	
			'degree_to_3' => 'nullable|required_with:edu_institution_3|after_or_equal:degree_from_3',
		
			'dec_copy' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1024',
            'theological_cetificates_1' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1024',
            'theological_cetificates_2' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1024',
            'theological_cetificates_3' => 'nullable|mimes:pdf,jpg,jpeg,png|max:1024',
		];
	}

	public function niceNames()
	{
		return[
			'name' => 'Name',
			'state' => 'State',
			'created_by' => 'Created By',
			'created_at' => 'Created At',
			'denomination' => 'Denomination',
			'theological_qualification' => 'Theological Qualification',
			
			'languages_label' => 'Languages Known',
			'educational_label' => 'Educational Qualifications',
			'contact_details_label' => 'Contact Details',
			'other_details_label' => 'Other Details',
			'bank_account_label' => 'Bank Accounts',
			
			'status' => 'Status',
			
			'photo' => 'Photo',
			'address_proof_copy' => 'Address Proof Copy',
			'testimony_copy' => 'Testimony Copy',
			'dec_copy' => 'Declaration Copy',
			'theological_cetificates_1' => 'Theological Certificate - 1' ,
			'theological_cetificates_2' => 'Theological Certificate - 2' ,
			'theological_cetificates_3' => 'Theological Certificate - 3' ,
			'code' => 'Tutor Code',	
			'project_code' => 'Project Code',	
			'full_name' => 'Tutor Name',	
		];
	}
	
    public function files()
    {
        return [        
            'photo',
			'address_proof_copy',
			'testimony_copy',
			'dec_copy',
			'theological_cetificates_1',
			'theological_cetificates_2',
			'theological_cetificates_3',
        ];
    }
	public function dropDownNames()
	{
		return[
			'zone' => 'zones',
			'state' => 'states',
			//'project_year' => 'ict_project_years',
		];
	}
	
	
	public function anySearchNames()
	{
		return[		
			//'project_year',
			'project_code',
			'full_name',
			//'zone',
		];
	}
	
	public function searchNames()
	{
		return[	
		//	'project_year',
			'project_code',
			'full_name',
			//'zone',	
		];
	}
	public function relatedNames()
	{
		return[		
			'zone' => 'project,zone',
			'full_name' => 'ict_tutors.person,full_name',			
		];
	}
	
	/**
     * Relationship Project
     */
    public function project() {
        return $this->belongsTo('App\Models\IctProject');
    }
	
	public function projects(){
		$tutor_records = IctTutor::where('person_id',$this->person_id)->whereNull('deleted_at')->get();
		$projectID[]='';
		foreach($tutor_records as $tutor_record)
		{
			//$projectID = $tutor_record->project_id;
			array_push($projectID,$tutor_record->project_id);
		}
		$projects = IctProject::whereIn('id',$projectID)->orderBy('project_code','DESC')->get();
		return $projects;
	}
	
	public function active_projects(){
			
		if(date("m") > 8)
			$last_start_date = date('Y-12-31', strtotime("-1 year"));
		else
			$last_start_date = date('Y-06-30', strtotime("-1 year"));
		
		if(date("m") < 6)
			$next_start_date = date('Y-07-01');
		else
			$next_start_date = date('Y-01-01', strtotime("+1 year"));
		
		$tutor_records = IctTutor::where('person_id',$this->person_id)->whereNull('deleted_at')->get();
		$projectID[]='';
		foreach($tutor_records as $tutor_record)
		{
			//$projectID = $tutor_record->project_id;
			array_push($projectID,$tutor_record->project_id);
		}
		$projects = IctProject::whereIn('id',$projectID)->where('start_date','>',$last_start_date)->where('start_date','<',$next_start_date)->orderBy('project_code','DESC')->get();
		return $projects;
	}
	
	public function other_projects(){			
		if(date("m") > 8)
			$last_start_date = date('Y-12-31', strtotime("-1 year"));
		else
			$last_start_date = date('Y-06-30', strtotime("-1 year"));
		
		if(date("m") < 6)
			$next_start_date = date('Y-07-01');
		else
			$next_start_date = date('Y-01-01', strtotime("+1 year"));

		$tutor_records = IctTutor::where('person_id',$this->person_id)->whereNull('deleted_at')->get();
		$projectID[]='';
		foreach($tutor_records as $tutor_record)
		{
			//$projectID = $tutor_record->project_id;
			array_push($projectID,$tutor_record->project_id);
		}
		$projects = IctProject::whereIn('id',$projectID)->where('start_date','<',$last_start_date)->orWhere('start_date','>',$next_start_date)->orderBy('project_code','DESC')->get();
		return $projects;
	}
	
	/**
     * Relationship Project
     */
    public function ict_top() {
        return $this->hasOne('App\Models\IctTopParticipant', 'participant_id');
    }
	
	/**
     * Relationship Payment
     */
	public function payments()
    {
        return $this->hasMany('App\Models\IctProjectPayment', 'tutor_id');
    }
	
	public function hasRequiredFiles() {
		
		return !empty($this->person && $this->person->hasCompleted());
		
	}
	
	public function type() {
		return 'tutor';
	}
	
	public function programs() {
		return [
			'ict_top' => 'ICT TOP',
		];
	}
	
	public function route() {
		return route('ict_tutor.view', [$this->project->id, $this->id]);
	}	
	
/*	public function code() {
		return $this->project->code();
	}	
	*/
	public function getId() {
		return $this->project->code();
	}
	
	public function isValid($project, $person, $add = true) {
		$project_incharge = $project->project_incharge();
		if (!$project_incharge) {
			return false;
		}
		if ($project_incharge->person->id == $person->id) {
			return false;
		}
		
		return true;
	}
	public function bankmaster_records()
    {
        return $this->hasMany('App\Models\IctBankmasterRecord', 'ict_tutor_id');
    }
	
/*	public function code(){
		
		return $this->code;
	}*/
	protected static function boot()
    {
		parent::boot();
        
		static::saving(function ($model) {
			/*if (!empty($model->project->code())) { 
				if (empty($model->code)) {
					$count = $model->project->ict_tutors()->whereNotNull('code')->count()+1;
					$model->code = $model->project->code().'-T'.$count;
				}
			}*/
			/* if (empty($model->code) && !empty($model->project->project_code)) {                    
					$count = IctTutor::withTrashed()->where('project_id', $model->project->id)->whereNotNull('code')->count() + 1;
                    $model->code = $model->project->project_code.'-T'.$count;
            }	*/
		});
		
    }
	
	
	public function createPayments(&$project) {
		$budget = BudgetPaymentHelper::budget($project);
		if ($project->entity == 'LH'
  		 || $project->isFcra() 
		 || !$this->isActive()
		 || !$budget) {
			return;
		}
		
		if ($this->parent && $this->parent->payments()->whereNotIn('term', ['ttp', 'ltp', 'pop'])->count() > 0) {
			return;
		}
		
		$terms = BudgetPaymentHelper::terms($project);
		foreach ($terms as $k => $v) {
			if(in_array($k, ['ttp', 'ltp', 'pop'])) { // ttp should not be added from here
				continue;
			}
			if ($project->name() == 'ict_project') {					
				// residential amount
				if (in_array($k, ['1r', '2r', '3r'])) {
					//$singleTutorAmount = $budget->tutor_honorarium / 4;
					$this->addPayment($k, 'tutor_honorarium', $budget->tutor_honorarium);	
				}	
			}
		}
	}
	
	public function addPayment($term, $category, $amount) {
		if (!$amount || $amount <= 0) { 
			return;
		}
		if (!$this->canAddPayment($term, $category)) {
			// Check whether it is already participate in indent or not
			$indentPayment = $this->getIndentPayment($term, $category); 
			
			if (!$indentPayment || $indentPayment->indent()) { // if indent also started we shold not add payment
				return;
			}
			
			// now check the amounts wether we can append
			$existingAmount = $this->getPaymentAmount($term, $category);
			if ($existingAmount == $amount) { //no need to do anything
				return;
			} 
			$indentPayment->amount = $amount;
			$indentPayment->save();
			return;
		}	
		$payment_model = $this->getRelatedModel('payments');
		$payment = new $payment_model;
		$payment->term = $term;
		$payment->category = $category;
		$payment->amount = $amount;
		$payment->bills_required = $this->project->billsRequired($category);
		
		$payment->project_id = $this->project_id;
		$payment->tutor_id = $this->id;
		$payment->save();
		return $payment;
	}
	
	public function canAddPayment($term, $category) {
		$payment_model = $this->getRelatedModel('payments');
		
		$payment = $payment_model::where('tutor_id', $this->id)
					   ->where('term', $term)
					   ->where('category', $category)
					   ->first();
		return ($payment) ? false : true;
	}
	
	public function isActive() {
        return !in_array($this->status, ['inactive']);
	}
	
	public function getFullCodeAttribute() {			
		return  $this->person->tutor_code;
	}
	
	public function indexRoute() {
		return route('ict_tutors',[$this->name()]);
	}
	public function replacement()
    {
        return $this->hasOne('App\Models\IctTutor', 'replacement_id');
    }
	public function relations() {
		return [
			'person' => ['belongsTo', Person::class],
		];		
	}
	
}