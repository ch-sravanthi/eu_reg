<?php
namespace App\Models;

use App\AppModelNew;
use Auth;
use App\Helpers\AppHelper;
use ModelHelper;

class Person extends AppModelNew{


	protected $table = 'persons';
	
	protected $appends = ['age'];

	public $fillable = [
		'full_name',
		'title',
        'birthdate',
        'gender',
        'marital_status',
        'children_count',

        'state',
        'district',
        'city',
        'street_address',
		'h_no',
        'pin',
        'address_proof_type',
        'address_proof_id',
        'std',
        'phone',
        'phone_mobile',
        'email',

        'testimony',
        'languages',
        'educational_qualifications',
		'previous_exp',
		'min_exp',
		'pan_card',
		'pan_card_copy',
		'tutor_code',
		'instructor_code',
		'family_background',
		'belief_faith',
		'lifestyle',
		'when_date',
		'where_place',
		'who_led_you',
		'what_occasion',
		'bible_verse',
		'glorify_god',
		'theological_qualifications',
		'intrest',
		'job_profession',
		'is_facilitator_related',
		'facilitator_relationship',
		
		//Bank Details will be used in Bank Account Model and unset in Incharge Controller
		'passbook_name',
		'account_no',
		'bank_name',
		'branch_name',
		'branch_code',
		'ifsc_code',
		'swift_code',
		'passbook_copy',
		'bank_statement',
		
		'photo',
		'address_proof_copy',
		
	];

	public function rules()
	{
        return[
            'full_name' => 'required|max:255|name',
            'title' => 'required',
            'birthdate' => 'required|date|before_or_equal:'.date('Y-m-d', strtotime("-15 years")),
            'gender' => 'required',
            'marital_status' => 'nullable',
            'children_count' => 'nullable',

            'state' => 'required',
            'district' => 'required',
            'city' => 'required',
            'street_address' => 'required',
			'h_no' => 'required',
            'pin' => 'required|numeric|min:100000|max:999999',
            'address_proof_type' => 'required',
			'address_proof_id'=> "required|new_address_proof_id",
            'std' => 'nullable|numeric|min:1|max:999999',
            'phone' => 'nullable|numeric',
            'phone_mobile' => 'required|mobile',
            'testimony' => 'nullable',
            'email' => 'nullable',
			'job_profession' => 'nullable',
            'languages' => 'required',
            'min_exp' => 'nullable',
            'intrest' => 'nullable',
            'educational_qualifications' => 'required',
            'theological_qualifications' => 'nullable',
			'is_facilitator_related' => 'nullable',
			'facilitator_relationship'=> 'nullable',
            //'previous_exp' => 'required',
			'family_background' => 'required_without:testimony',
			'belief_faith' => 'required_without:testimony',
			'lifestyle' => 'required_without:testimony',
			'when_date' => 'nullable',
			'where_place' => 'nullable',
			'who_led_you' => 'required_without:testimony',
			'what_occasion' => 'required_without:testimony',
			'bible_verse' => 'nullable',
			'glorify_god' => 'required_without:testimony',

            'photo' => 'required|mimes:jpg,jpeg,png',
            'address_proof_copy' => 'required|mimes:jpg,jpeg,png',
            'dec_copy' => 'nullable|mimes:jpg,jpeg,png,pdf',
			'testimony_copy' => 'nullable|mimes:pdf,doc,docx'
        ];
	}

	public function basicRules()
	{
        return[
            'full_name' => 'required',
            'title' => 'required',
            'gender' => 'nullable',
			'address_proof_type' => 'required',
			'address_proof_id'=> "required|address_proof_id",
            'state' => 'required',
            'district' => 'required',
            'city' => 'nullable',
            'street_address' => 'nullable',
			'h_no' => 'required',
            'pin' => 'nullable|numeric|min:100000|max:999999',
            'std' => 'nullable|numeric|min:1|max:999999',
            'phone_mobile' => 'nullable|mobile',

            'photo' => 'nullable|mimes:jpg,jpeg,png',
            'address_proof_copy' => 'nullable|mimes:jpg,jpeg,png|min: 25|max: 1024',
        ];
	}

	public function niceNames()
	{
            return [
			'full_name' => 'Full Name (As per Aadhaar)',
			'title' => 'Title',
            'photo' => 'Photo',
            'birthdate' => 'Date of Birth (As per Aadhaar)',
            'gender' => 'Gender',
            'marital_status' => 'Marital Status',
            'children_count' => 'No.of Children',

            'state' => 'State',
            'district' => 'District',
            'city' => 'Town/Mandal/Taluk',
            'street_address' => 'Street/Locality/Village',
			'h_no' => 'H.No',
            'pin' => 'PIN Code',
            'std' => 'STD Code',
            'phone' => 'Telephone No.',
            'phone_mobile' => 'Mobile No.',
            'email' => 'Email',
			'location' => 'Location of the Center',
			'location_latlong' => 'Latitude & Longitude',
            'address_proof_type' => 'Address Attachment',
            'address_proof_id' => 'Aadhaar Number',
			
			//Revised Testimony Fields
			
            'family_background' => 'Family background  ',
            'belief_faith' => 'Belief (faith/religious background) ',
            'lifestyle' => 'Lifestyle (how were they living – habits/language) ',
            'when_date' => 'Accepted Date/ Year(optional) ',
            'where_place' => 'Accepted Place (optional) ',
            'who_led_you' => 'Who led you to Christ',
            'what_occasion' => 'What Occasion',
            'bible_verse' => 'Bible Verse (optional)',
            'glorify_god' => 'Glorify God (his/her current lifestyle/behavior changes)',
			
			'passbook_name' => 'Name(as per the bank Passbook)',
			'account_no' => 'Account Number',
			'bank_name' => 'Bank Name',
			'branch_name' => 'Branch Name',
			'branch_code' => 'Branch Code',
			'ifsc_code' => 'IFSC Code',		
			'swift_code' => 'Swift Code',			
			'passbook_copy' => 'Bank Passbook Copy',
			'bank_statement' => 'Bank Statement',
			'fcra_copy_apv' => 'FCRA Approval Copy',
			'is_facilitator_related' => 'Are You Relative of the Facilitator? - (for Center Incharges)',
			'facilitator_relationship' => 'What is the Relationship?',
			

            'testimony' => 'Personal Testimony',
            'languages' => 'Languages Known',
			'educational_qualifications' => 'Educational Qualification',
			'theological_qualifications' => 'Theological Qualification',
			'job_profession' => 'Job/Profession',
            'previous_exp' => 'Any previous Experience',
            'min_exp' => 'Ministry Experience',
			'intrest' => 'Why are you intrested in this program',
			'address_proof_copy' => 'Aadhar Proof Copy',

			'dec_copy' => 'Declaration Copy',
            'testimony_copy' => 'Testimony Copy',

			'personal_details_label' => 'Personal Details',
			'address_proof_label' => 'Address Proof',
			'contact_details_label' => 'Contact Details',
			'other_details_label' => 'Other Details',
			'payment_details_label' => 'Payment Record',
			'bank_account_label' => 'Bank Accounts',
			'location_label' => 'Center Location',

			'pan_card' => 'PAN Card',
			'pan_card_copy' => 'PAN Card Copy',
			'tutor_code' => 'Tutor Code',
			'wep_instructor' => 'Instructor Code',
        ];
    }

	public function panRules()
	{
		$id = $this->id;
        return[
			'pan_card' => "required|pan|unique:persons,pan_card,{$id},id,deleted_at,NULL",
            'pan_card_copy' => 'required|mimes:jpeg,jpg,png|max:512'
		];
	}
    public function files()
    {
        return [
            'photo',
		    'address_proof_copy',
			'testimony_copy',
        ];
    }


	public function anySearchNames()
	{
		return[
			'full_name',
			'address_proof_id',
			'phone_mobile',
		];
	}

	public function searchNames()
	{
		return[
			'full_name',
			'address_proof_id',
			'phone_mobile',
			'state',
		];
	}

	public function dropDownNames()
	{
		return[
			'state' => 'states',
		];
	}

	public function relatedNames()
	{
		return[
			//'full_name' => 'full_name',
		];
	}
	/**
     * Relationship Bank Account
     */
    public function bank_accounts()
    {
        return $this->belongsToMany('App\Models\BankAccount')->withPivot('invalid');
    }

	/**
     * Relationship Person File
     */
    public function attachments()
    {
        return $this->hasMany('App\Models\PersonFile', 'parent_id');
    }

	/**
     * Relationship Log
     */
    public function logs()
    {
        return $this->hasMany('App\Models\PersonLog', 'parent_id');
    }

	/**
     * Relationship Ict project Incharge
     */
    public function ict_project_incharges()
    {
        return $this->hasMany('App\Models\IctProjectIncharge', 'person_id');
    }

	/**
     * Relationship Asc project Incharge
     */
    public function ict_center_incharges()
    {
        return $this->hasMany('App\Models\IctCenterIncharge', 'person_id');
    }

	/**
     * Relationship Ict Tutur
     */
    public function ict_tutors()
    {
        return $this->hasMany('App\Models\IctTutor', 'person_id')->orderBy('project_id','DESC');
    }

	/**
     * Relationship Ict Tutur
     */
    public function wep_instructors()
    {
        return $this->hasMany('App\Models\WepInstructor', 'person_id')->orderBy('project_id','DESC');
    }
	/**
     * Relationship Al project Incharge
     */
    public function al_project_incharges()
    {
        return $this->hasMany('App\Models\AlProjectIncharge', 'person_id');
    }

	/**
     * Relationship Al Center Incharge
     */
    public function al_center_incharges()
    {
        return $this->hasMany('App\Models\AlCenterIncharge', 'person_id');
    }

	 public function dlc_project_incharges()
    {
        return $this->hasMany('App\Models\DlcProjectIncharge', 'person_id');
    }
	public function dlc_center_incharges()
    {
        return $this->hasMany('App\Models\DlcCenterIncharge', 'person_id');
    }
	/**
     * Relationship Al Learner
     */
    public function center_beneficiaries()
    {
        return $this->hasMany('App\Models\AlLearner', 'person_id');
    }
	/**
     * Relationship Cbc project Incharge
     */
    public function cdp_ttp_project_incharges()
    {
        return $this->hasMany('App\Models\CdpTtpProjectIncharge', 'person_id');
    }

	/**
     * Relationship Asc project Incharge
     */
    public function asc_project_incharges()
    {
        return $this->hasMany('App\Models\AscProjectIncharge', 'person_id');
    }

	/**
     * Relationship Asc project Incharge
     */
    public function asc_center_incharges()
    {
        return $this->hasMany('App\Models\AscCenterIncharge', 'person_id');
    }

	public function keyleaders()
    {
        return $this->hasMany('App\Models\DsKeyleader', 'person_id');
    }

	public function ict_pop_participant() {
        return $this->hasMany('App\Models\IctFopParticipant', 'person_id');
	}

	public function al_pop_participant() {
        return $this->hasMany('App\Models\AlFopParticipant', 'person_id');
	}

	public function cbc_pop_participant() {
        return $this->hasMany('App\Models\CbcPopParticipant', 'person_id');
	}

	/**
     * Relationship Asc Interviewees
     */
    public function asc_interviewees()
    {
        return $this->hasMany('App\Models\AscInterviewee', 'person_id');
    }

	public function dp_volunteers()
    {
        return $this->hasMany('App\Models\DpVolunteer', 'person_id');
    }


	 public function cdp_donor()
    {
        return $this->hasOne('App\Models\CdpDonor', 'person_id');
    }
	 public function al_donor()
    {
        return $this->hasOne('App\Models\AlDonor', 'person_id');
    }

	/**
     * Relationship Asc Interviewees
     */
    public function ds_rm()
    {
        return $this->hasMany('App\Models\DsRmParticipant', 'participant_id');
    }

	public function llt_center_incharges()
    {
        return $this->hasMany('App\Models\LltCenterIncharge', 'person_id');
    }
	
	public function llt_project_incharges()
    {
        return $this->hasMany('App\Models\LltProjectIncharge', 'person_id');
    }

	public function llt_master_trainers()
    {
        return $this->hasMany('App\Models\LltMasterTrainer', 'person_id');
    }

	public function wep_project_incharges()
    {
        return $this->hasMany('App\Models\WepProjectIncharge', 'person_id');
    }


	public function wep_llt_center_incharges()
    {
        return $this->hasMany('App\Models\WepLltCenterIncharge', 'person_id');
    }


	/**
     * Relationship Replication Master Incharge
     */
    public function rep_master_trainers()
    {
        return $this->hasMany('App\Models\ReplicationMasterTrainer', 'person_id');
    }

    public function getMobileAttribute()
    {
        return $this->phone_mobile;
    }

	public function relations() {
		return [
			'active_bank_account' => ['belongsTo', BankAccount::class],
		];		
	}
	
	protected static function boot()
    {
		parent::boot();

		// add project code while saving for approved projects
		static::saving(function ($model) {
			$model->full_name = ucwords(strtolower($model->full_name));
			if($model->ict_tutors->count() > 0 && empty($model->tutor_code))
			{
				$zone = AppHelper::getZone($model->state);
				$states = AppHelper::getStates($zone);
				$zone = AppHelper::dropdown($zone, 'departments_shortcode');
				foreach($states as $k=>$v)
				{
					$state[] = $k;
				}
				$count = $model::withTrashed()->where('state',$model->state)->whereNotNull('tutor_code')->count() + 1;

				$no = $count;
				for ($i=0; $i<5-strlen($count);$i++) {
					$no ='0'.$no;
				}
				$model->tutor_code = strtoupper($zone).'-'.strtoupper($model->state).'-T'.$no;
			}
			if($model->wep_instructors->count() > 0 && empty($model->instructor_code))
			{
				$zone = AppHelper::getZone($model->state);
				$states = AppHelper::getStates($zone);
				$zone = AppHelper::dropdown($zone, 'departments_shortcode');
				foreach($states as $k=>$v)
				{
					$state[] = $k;
				}
				$count = $model::withTrashed()->where('state',$model->state)->whereNotNull('instructor_code')->count() + 1;

				$no = $count;
				for ($i=0; $i<5-strlen($count);$i++) {
					$no ='0'.$no;
				}
				$model->instructor_code = strtoupper($zone).'-'.strtoupper($model->state).'-T'.$no;
			}
        });
    }

    public function route()
    {
        return route('person.view', $this->id);
    }


	public function getPop($program) {
		$participant = $this->getPopParticipant($program);
		if ($participant) {
			return $participant->program;
		}
	}

	public function getPopParticipant($program) {
		$relationship ="{$program}_pop_participant";
		return $this->$relationship()->latest()->first();
	}

    /**
     * Check if person has bank account.
     *
     * @return boolean
     */
	public function hasBankAccount() {
		return ($this->bank_account()) ? true : false;
	}

	/**
     * Get latest valid bank account
	 *
     * @return \App\Models\BankAccount
     */
    public function bank_account()
    {
		foreach ($this->bank_accounts as $bank_account) {
			if ($bank_account->isValid()) {
				return $bank_account;
			}
		}
    }

	public function fullname() {
		return $this->full_name;
	}

	public function phone_mobile () {
		return $this->phone_mobile;
	}

	public function getByAddressProof($address_proof_id) {
		return $this::where('address_proof_id', $address_proof_id)->first();
	}

	public function address() {
		return AppHelper::dependent($this->district, $this->state, 'districts') .', '.
			   strtoupper($this->state);
	}

	public function hasCompleted() {
		foreach ($this->files() as $file) {
			if (empty($this->$file)) {
				return false;
			}
		}
		return true;
	}
	/*
	public function relations() {
		return [
			'ict_project_incharges' => 'ICT Facilitator',
			'ict_tutors' => 'ICT Tutor',
			'ict_center_incharges' => 'ICT Student',
			'al_project_incharges' => 'AL Facilitator',
			'al_center_incharges' => 'AL Assistant',
			'cdp_ttp_project_incharges' => 'CDP Incharge',
			'asc_project_incharges' => 'ASC Facilitator',
			'asc_center_incharges' => 'ASC Club Leader',
			'wep_instructors' => 'WEP Instructor',
			'dlc_project_incharges' => 'DLC Facilitator',
			'dlc_center_incharges' => 'DLC Assistant',
		];
	}

	public function otherRelations() {
		return [
			'llt_center_incharges' => 'LEAP Lay Leader',
			'llt_project_incharges' => 'LEAP Key Leader',
			'llt_master_trainers' => 'LEAP Master Traiiners',
			'rep_master_trainers' => 'Replication Master Traiiners',
			'wep_project_incharges' => 'WEP LEAP Facilitator',
			'wep_llt_center_incharges' => 'WEP LEAP Lay Leader',
			'dp_volunteers' => 'DP VOlunteer',
		];
	}
	*/
	public function canEdit() {
		/*
		foreach ($this->bank_accounts as $bank_account) {
			if (!$bank_account->canEditBasic()) {
				return false;
			}
		}*/

		$count = 0;
		foreach (($this->relations() + $this->otherRelations()) as $relation => $label) {
			$count+= $this->$relation()->whereNotIn('status', ['inactive'])->count();
			if ($count >= 2) {
				return false;
			}
		}
		return true;
	}

	public function isNew() {
		foreach ($this->relations() as $relation => $label) {
			if ($relation == 'cdp_ttp_project_incharges') {
				continue;
			}
			$count = $this->$relation()->whereNotIn('status', ['inactive'])->count();
			if ($count > 0) {
				foreach ($this->$relation()->whereNotIn('status', ['inactive'])->get() as $incharge) {
					if ($incharge->project && $incharge->project->status == 'other') {
						$count--;
					}
				}

				if ($count > 0) {
					return false;
				}
			}
		}
		return true;
	}


	public function isValid($project_year) {
		$explode = explode("-", $project_year);
		$year = $explode[1];
		$relations = $this->relations();
		unset($relations['ict_tutors']);
		unset($relations['cdp_ttp_project_incharges']);
		$count = 0;
		foreach ($relations as $relation => $label) {
			$incharges = $this->$relation()->whereHas('project', function($query) use ($year) {
							$query->where('project_year', 'like', "%$year%");
						})->whereNotIn('status', ['inactive'])->get();
			$c = count($incharges);


			if ($c == 1 || ($relation != 'al_project_incharges')) {
				$count+= $c;
			} else {
				$y = 0;
				$o = 0;
				foreach ($incharges as $incharge) {
					if ($incharge->project->special_project == 'Y')  {
						$y++;
					} else {
						$o++;
					}
				}

				if ($y == 0) {
					$count+= $o;
				} elseif ($o == 0) {
					$count+= $y;
				} else {
					$count+= $o;
				}
			}

			if ($count >= 2) {
				return false;
			}
		}
		return true;
	}

	public function inchargeByYear($project_year, $canTutor = true, $onlyProjectIncharge = false) {
		$year = (int) filter_var($project_year, FILTER_SANITIZE_NUMBER_INT);
		$relations = $this->relations();
		if ($canTutor) {
			unset($relations['ict_tutors']);
		}
		if ($onlyProjectIncharge) {
			unset($relations['ict_project_incharges']);
			unset($relations['al_project_incharges']);
			unset($relations['asc_project_incharges']);
		}
		unset($relations['cdp_ttp_project_incharges']);
		$data = [];
		foreach ($relations as $relation => $label) {
			$incharges = $this->$relation()->whereHas('project', function($query) use ($year) {
							$query->where('project_year', 'like', "%$year%");
							$query->whereNotIn('status', ['inactive']);
						})->whereNotIn('status', ['inactive'])->get();
			foreach($incharges as $incharge) {
				if ($incharge->project->special_project == 'Y') {
					continue; //ignore spl project
				}
				array_push($data, $incharge);
			}
		}
		return $data;
	}

	public function getAgeAttribute()
	{
		return AppHelper::age($this->birthdate);

	}

	public function getBeneficiary($department = null) {
		$models = [];
		foreach (($this->relations() + $this->otherRelations()) as $relation => $label) {
			foreach ($this->$relation()->orderBy('created_at', 'desc')->get() as $model) {
				if ($department){
					if ($model->project && !empty($model->project->code())) {
						if (($department == 'ict' && $model->project->name() == 'ict_project') || ($department == 'al' && $model->project->name() == 'al_project') || ($department  == 'cdp' && $model->project->name() == 'asc_project')|| ($department  == 'wep' && $model->project->name() == 'wep_project')) {
							return $model;
						}
					}
				} else {
					return $model;
				}
			}
		}
	}

	public function type() {
		return 'person';
	}

	public function pan() {
		return null;
	}

	public function getFullAddressAttribute() {
		return  $this->street_address.','.
				AppHelper::dependent($this->district, $this->state, 'districts').','.
				AppHelper::dropdown($this->state, 'states');
	}

	public function getFamilyMembersAttribute() {
		return  $this->marital_status == 'married' ? $this->children_count + 2 : 1;
	}
}
