<?php
namespace App\Models;

use App\AppModelNew;
use Auth;
use App\Helpers\AppHelper;

class Organization extends AppModelNew {


	public $fillable = [
		'organization_name',
		'is_registered',
		'registration_type',
		'registration_number',
		'registration_attachment',
		'registration_date',
		'is_fcra',
		'fcra_no',
		'fcra_copy',
		/*'passbook_name',
		'account_no',
		'ifsc_code',
		'swift_code',
		'bank_name',
		'branch_name',
		'branch_code',
		'passbook_copy',
		'fcra_copy_apv',*/
		'objectives',
		'denomination',
		'sub_denomination',
		'organization_type',
		'description',
		'is_church',
		'state',
		'district',
		'city',
		'street',
		'pin',
		//'phone',
		'phone_mobile',
		'email',
		'titles',
		'organization_head',
        'address_proof_id',
        'id_proof',
		'photo',
		'designation',
		'gender',
		'partner_id',
		
	//	'std',
	//  'address_proof_type',
	//	'age',
	//	'marital_status',
	];

	public function rules($organization_head)
	{
		//$id = $this->id;
        return[
		'organization_name' => 'required',
		
		
		'is_registered' => 'required',
		'registration_type' => 'required_if:is_registered,Yes',
		'registration_number' => 'required_if:is_registered,Yes',
		'registration_attachment' => 'nullable|file|required_if:is_registered,Yes|mimes:jpeg,jpg,png,pdf|max:1024',
		
		'registration_date' => 'required_if:is_registered,Yes',	
		'is_fcra' => 'required_if:is_registered,Yes',
		'fcra_no' => 'required_if:is_fcra,Yes',
		'fcra_copy' => 'nullable|file|required_if:is_fcra,Yes|mimes:jpeg,jpg,png,pdf|max:1024',
		'passbook_name' => 'required_if:is_fcra,Yes',
		'account_no' => 'required_if:is_fcra,Yes',
		'ifsc_code' => 'required_if:is_fcra,Yes',
		'swift_code' => 'required_if:is_fcra,Yes',
		
		'bank_name' => 'required_if:is_fcra,Yes',
		'branch_name' => 'required_if:is_fcra,Yes',
		'branch_code' => 'required_if:is_fcra,Yes',
		'passbook_copy' => 'nullable|file|required_if:is_fcra,Yes|mimes:jpeg,jpg,png|max:1024',
		'fcra_copy_apv'=> 'nullable|file|required_if:is_fcra,Yes|mimes:jpeg,jpg,png,pdf|max:1024',
		'objectives' => 'nullable',
		'denomination' => 'required',
		'sub_denomination' => 'nullable',
		'organization_type' => 'required_if:is_registered,No',
		'description' => 'required_if:is_registered,No',
		'is_church' => 'required_if:is_registered,Yes',
		'state' => 'required',
		'district' => 'required',
		'city' => 'required',
		'street' => 'required',
		'pin' => 'required|numeric|min:100000|max:999999',
		//'phone' => 'nullable|numeric',
		'phone_mobile' => 'required|mobile',
		'email' => 'required|email',
		'titles' => 'required',
       
		'organization_head' => 'required|name',
        'address_proof_id' => "required",
		
		'id_proof' => 'nullable|mimes:jpeg,jpg,png|max:1024',
		'photo' => 'nullable|mimes:jpeg,jpg,png|max:1024',
		'designation' => 'required',
        'gender' => 'required',	
		'pi_required' => 'nullable|boolean',
		
		
     //   'age' => 'nullable|numeric|min:18|max:80',
    //    'marital_status' => 'nullable',
	//	'address_proof_type' => 'nullable',
    //    'std' => 'nullable|numeric|min:1|max:999999',
     //   'org_profile_copy' => 'nullable|mimes:pdf|max:1024',
			
        ];
	}

	public function niceNames()
	{
            return [
			'organization_name' => 'Organization Name', 
			'is_registered' => 'Is your organization registered with government? ',
			'registration_type' => 'Registration Type',
            'registration_number' => 'Registration Number',  
			'registration_attachment' => 'Registration Attachment',
            'registration_date' => 'Date of Registration',
			'is_fcra' => 'Registered under FCRA',
			'fcra_no'	=> 'FCRA Number.',
			'fcra_copy' => 'FCRA Attachment',
			'passbook_name' => 'Name(as per the bank Passbook)',
			'account_no' => 'Account Number',
			'ifsc_code' => 'IFSC Code',
			'swift_code' => 'Swift Code',
			'bank_name' => 'Bank Name',
			'branch_name' => 'Branch Name',
			'branch_code' => 'Branch Code',
			'objectives' => 'Organization Objectives',
			'denomination' => 'Denomination',
            'sub_denomination' => 'Sub-Denomination',
			'organization_type' => 'Organization Type',
			'description' => 'Brief Description of Organization',
			'is_church' => 'Is your organization a Church/Denomination?',
			'state' => 'State',
			'district' => 'District',
            'city' => 'Town/Mandal/Taluk/Sub-District',
            'street' => 'House No./Street/Building Name',
            'pin' => 'Pin',
			'std' => 'STD Code',
            'phone' => 'Landline No.',
            'phone_mobile' => 'Mobile No.',
            'email' => 'Head of the Organization Email ID',
			'titles' => 'Title of Head of Organization (Salutation)',
			 'organization_head' => 'Full Name of Head of Organization (As per Aadhaar) ',
			'address_proof_id' 	=> 'Aadhaar Number',
			'id_proof' => 'Aadhaar Attachment',
			'photo' => 'Head of the Organization Photo',
			'designation' => 'Designation/Position of Head of Organization',
            'gender' => 'Gender',
			'passbook_copy' => 'Bank Passbook Copy',
			'fcra_copy_apv' => 'FCRA Approval Copy',
			
			
            'age' => 'Age',
            'marital_status' => 'Marital Status',
            'partner_id' => 'Partner ID',
			'mi' => 'Prism',
			'org_profile_copy' => 'Organization Registration Copy',
			'organization_details_label' => 'Organization Details',
			'organization_address_label' => 'Organization Address',
			'bank_account_label' => 'Bank Accounts',
			'address_proof_type'  => 'Address Proof Type',
			'comments' => 'Comments',
			'address_proof_label' => 'Address Proof',
			'bank_statement' => 'Bank Statement',
			'status_details' => 'Bank Status',

        ];
    }

    public function files()
    {
        return [
            'photo',
			'registration_attachment',
			'fcra_copy',
			'id_proof',
			'passbook_copy',
			'fcra_copy_apv',
        ];
    }
/*
	public function files($fcra = 'no')
    {
		if ($fcra == 'yes') {
			return [
				'photo',
				'org_profile_copy',
				'fcra_copy',
				'id_proof'
			];
		} else {
			return [
				'photo',
				'org_profile_copy',
				'id_proof'
			];
		}
    }

	 public function filesMinimum($fcra)
    {
		if ($fcra == 'yes') {
			return [
				'photo',
				'org_profile_copy',
				'fcra_copy',
				'id_proof'
			];
		} else {
			return [
				'photo',
			];
		}
    }*/

	public function anySearchNames()
	{
		return[
			'organization_name',
			'organization_head',
			'address_proof_id',
			'partner_id',
		];
	}

	public function searchNames()
	{
		return[
			'partner_id',
			'organization_name',
			'organization_head',
			'denomination',
			'state',
			'address_proof_id',
		];
	}

	public function dropDownNames()
	{
		return[
			'denomination' => 'denominations',
			'state' => 'states',
		];
	}

	public function relatedNames()
	{
		return[

		];
	}

	/**
     * Relationship Program Request
     */
    public function program_requests()
    {
        return $this->hasMany('App\Models\ProgramRequest');
    }

    /**
     * Relationship ICT Project
     */
    public function ict_projects()
    {
        return $this->hasMany('App\Models\IctProject');
    }

    /**
     * Relationship Al Project
     */
    public function al_projects()
    {
        return $this->hasMany('App\Models\AlProject');
    }

	/**
     * Relationship Dp Project
     */
    public function dp_projects()
    {
        return $this->hasMany('App\Models\DpProject');
	}
    /**
     * Relationship Wep Project
     */


    /**
     * Relationship Wep Project
     */
    public function wep_projects()
    {
        return $this->hasMany('App\Models\WepProject');
    }

    /**
     * Relationship Cdp Ttp Project
     */
    public function cdp_ttp_projects()
    {
        return $this->hasMany('App\Models\CdpTtpProject');
    }

    /**
     * Relationship Asc Project
     */
    public function asc_projects()
    {
        return $this->hasMany('App\Models\AscProject');
    }

	/**
     * Relationship Bank Account
     */
    public function bank_accounts()
    {
        return $this->belongsToMany('App\Models\BankAccount');
    }

	/**
     * Relationship Log
     */
    public function logs()
    {
        return $this->hasMany('App\Models\Organization\OrganizationLog', 'parent_id');
    }

	/**
     * Get latest Bank Account
     */
    public function bank_account()
    {
        //return $this->bank_accounts->first();
		return $this->bank_accounts()->where('bank_accounts.status', '<>', 'invalid')->first();
    }

	

    public function route()
    {
		return route('organization.details', $this->id);
    }

	public function projects(){
		return [
			'ict_projects',
			'al_projects',
		    'cdp_ttp_projects',
			'wep_projects',
			'asc_projects'
		];
	}

	public function canEdit() {
		if (Auth::user()->isAdmin()) {
			return true;
		}

		if (!empty($this->partner_id)) {
			return false;
		}
		$count = 0;
		foreach ($this->projects() as $relation) {
			$count+= $this->$relation()->whereNotIn('status', ['inactive'])->count();
			if ($count >= 2) {
				return false;
			}
		}
		return true;
	}

	public function canDelete() {
		foreach ($this->projects() as $relation) {
			if($this->$relation()->first()) {
				return false;
			}
		}
		if ($this->program_requests()->first()) {
			return false;
		}
		return true;
	}

	public function getByNameState($organization_name, $state) {
		return $this->where('organization_name', $organization_name)->where('state', $state)->first();
	}

	public function hasCompleted($fcra = 'no') {

		foreach ($this->files($fcra) as $file) {
			if (empty($this->$file)) {
				return false;
			}
		}
		if ($fcra == 'yes' && !$this->fcra_no) {
			return false;
		}
		if ($fcra == 'yes') {
			return $this->bank_account();
		}
		return true;
	}


	public function hasCompletedMinimum($fcra = 'yes') {

		foreach ($this->filesMinimum($fcra == 'yes') as $file) {
			if (empty($this->$file)) {
				return false;
			}
		}
		if ($fcra == 'yes' && !$this->fcra_no) {
			return false;
		}
		if ($fcra == 'yes') {
			return $this->bank_account();
		}
		return true;
	}

	public function hasRequiredFiles($fcra = 'no') {
		foreach ($this->files($fcra) as $file) {
			if (empty($this->$file)) {
				return false;
			}
		}
		return true;
	}

	public function fullname()
	{
		return $this->organization_name;
	}

	public function address() {
		return $this->street.', '.$this->city.', Pincode: '.$this->pin;
	}

	public function getId() {
		return $this->organization_name;
	}

	public function getAbbreviation() {
		$ret = '';
		foreach (explode(' ', $this->organization_name) as $word) {
			if (!empty($word))$ret .= strtoupper($word[0]);
		}
		return $ret;
	}

	public function indexRoute() {
		return route('organizations');
	}
	public function relations() {
		return [
			'bank_accounts' => ['hasMany', BankAccount::class],
			'active_bank_account' => ['belongsTo', BankAccount::class]
		];		
	}
}
