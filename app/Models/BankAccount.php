<?php
namespace App\Models;

use App\AppModelNew;
use App\Models\Al\AlFopIndentRecord;
use App\Models\Al\AlFopTravelIndentRecord;
use App\Models\Ict\IctFopIndentRecord;
use App\Models\Cbc\CbcPopIndentRecord;
use App\Models\Employee\Employee;
use App\Models\Cbc\CbcPopTravelIndentRecord;
use App\Models\Llt\LltPartner;
use App\Models\Llt\LltLayLeader;
use DB;
use AppHelper;
use ModelHelper;

class BankAccount extends AppModelNew
{
	
	protected $fillable = [
		'passbook_name',
		'account_no',
		'bank_name',
		'branch_name',
		'branch_code',
		'ifsc_code',
		'swift_code',
		'passbook_copy',
		'bank_statement',
		'fcra_copy_apv',
		'status',
		'comments'
	];
	
	public function basicRules()
	{
		$id = $this->id;
		$ifsc_code = request()->ifsc_code;
        return[
			'passbook_name' => 'required|max:255',
			'account_no' => "required|digits_between:0,18|unique:bank_accounts,account_no,{$id},id,deleted_at,NULL,ifsc_code,{$ifsc_code}",
			'branch_code' => 'nullable|max:255',
			'bank_name' => 'required',
			'ifsc_code' => 'required|ifsc',	
			'swift_code' => 'nullable|min:8',		
            'passbook_copy' => 'required|mimes:jpeg,jpg,png,pdf',
			'bank_statement' => 'nullable|mimes:jpeg,png,jpg,pdf',
			'fcra_copy_apv' => 'nullable|mimes:jpeg,png,jpg,pdf',
        ];
	}
	
	public function rules($type = 'person')
	{
		$ifsc_code = request()->ifsc_code;
		$rules = [
			'passbook_name' => 'required|max:255',
			'account_no' => "required|digits_between:0,18",
			'branch_code' => 'nullable|max:255',
			'bank_name' => 'required',
			'ifsc_code' => 'required|ifsc',	
			'swift_code' => 'nullable|min:8',		
            'passbook_copy' => 'required|mimes:jpeg,jpg,png,pdf',
			'bank_statement' => 'nullable|mimes:jpeg,png,jpg,pdf',
			'fcra_copy_apv' => 'nullable|mimes:jpeg,png,jpg,pdf',
		];
		
		if ($type == 'vendor' || $type == 'user') {
			unset($rules['branch_name']);
			unset($rules['branch_code']);
		}
		
		if ($type == 'user') {
			unset($rules['passbook_copy']);
		}
		return $rules;
	}
	
	public function changeRules($type = 'person')
	{
		$id = $this->id;
		$ifsc_code = request()->ifsc_code;
		$rules = [
			'passbook_name' => 'required|max:255',
			'account_no' => "required|digits_between:0,18|unique:bank_accounts,account_no,{$id},id,deleted_at,NULL,ifsc_code,{$ifsc_code}",
			'branch_code' => 'nullable|max:255',
			'ifsc_code' => 'required|ifsc',	
			'swift_code' => 'nullable|min:8',		
            'passbook_copy' => 'required|mimes:jpeg,jpg,png,pdf|min:30kb|max:10024kb',
			'bank_statement' => 'nullable|mimes:jpeg,png,jpg,pdf|min:30kb|max:1024kb',
			'change_reason' => 'required',
		];
		
		
		if ($type == 'vendor' || $type == 'user') {
			unset($rules['branch_name']);
			unset($rules['branch_code']);
		}
		
		if ($type == 'user') {
			unset($rules['passbook_copy']);
		}
		return $rules;
	}
	
	public function fewRules()
	{
		$rules = [
			'passbook_name' => 'required|max:255',			
            'passbook_copy' => 'required|mimes:jpeg,jpg,png,pdf',
		];
		return $rules;
	}

	public function niceNames()
	{
		return[
			'passbook_name' => 'Name(as per the bank Passbook)',
			'account_no' => 'Account Number',
			'bank_name' => 'Bank Name',
			'branch_name' => 'Branch Name',
			'branch_code' => 'Branch Code',
			'ifsc_code' => 'IFSC Code',		
			'swift_code' => 'Swift Code',			
			'passbook_copy' => 'Bank Passbook Copy',
			'bank_details_label' => 'Bank Details',
			'status' => 'Status',
			'bank_statement' => 'Bank Statement',
			'status_details' => 'Bank Status',
			'fcra_copy_apv' => 'FCRA Approval Copy',
		];
	}
	
	public function anySearchNames()
	{
		return[		
			'passbook_name',
			'account_no',
			'ifsc_code',
		];
	}
	
	public function searchNames()
	{
		return[	
			'passbook_name',
			'account_no',
			'ifsc_code',
			'bank_name',
			'status',
		];
	}
	
	public function dropDownNames()
	{
		return[
			'bank_name' => 'banks',
			'status' => 'bank_status',
		];
	}
	
	public function relatedNames()
	{
		return[		
			//'passbook_name' => 'passbook_name',	
		];
	}
	
	/**
     * Relationship Person
     */
    public function persons()
    {
        return $this->belongsToMany('App\Models\Person')->withPivot('invalid');
    }
	
	
	/**
     * Relationship Person
     */
    public function organizations()
    {
        return $this->belongsToMany('App\Models\Organization');
    }
	
	/**
     * Relationship Vendor
     */
    public function vendors()
    {
        return $this->belongsToMany('App\Models\Vendor');
    }
	
	/**
     * Relationship Vendor
     */
    public function general_vendors()
    {
        return $this->belongsToMany('App\Models\GeneralVendor');
    }
	
	
	/**
     * Relationship User
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
	
	/**
     * Relationship LLT Project Incharge
     */
    public function llt_project_incharges()
    {
        return $this->belongsToMany('App\Models\LltProjectIncharge');
    }
	
	/**
     * Relationship Employee
	*/
	 
    public function employees()
    {
        return $this->belongsToMany('App\Models\Employee\Employee');
    }
	
	/**
     * Relationship Log
     */
    public function logs()
    {
        return $this->hasMany('App\Models\BankAccountLog', 'parent_id');
    }
	
	/**
     * Relationship ICT TOP
     */
    public function ict_top_travel_indent_records()
    {
        return $this->hasMany('App\Models\IctTopTravelIndentRecord', 'bank_account_id');
    }
	
	/**
     * Relationship AL FOP
     */
    public function al_fop_travel_indent_records()
    {
        return $this->hasMany('App\Models\AlFopTravelIndentRecord', 'bank_account_id');
    }
	
	/**
     * Relationship AL TTP
     */
    public function al_ttp_travel_indent_records()
    {
        return $this->hasMany('App\Models\AlTtpTravelIndentRecord', 'bank_account_id');
    }
	
	/**
     * Relationship CBC POP
   */
    public function cdp_pop_travel_indent_records()
    {
        return $this->hasMany('App\Models\CdpPopTravelIndentRecord', 'bank_account_id');
    }  
	
	/**
     * Relationship ASC LTP
     */
    public function asc_ltp_travel_indent_records()
    {
        return $this->hasMany('App\Models\AscLtpTravelIndentRecord', 'bank_account_id');
    }
	
	/**
     * Relationship ASC ELTP
     */
    public function asc_eltp_travel_indent_records()
    {
        return $this->hasMany('App\Models\AscEltpTravelIndentRecord', 'bank_account_id');
    }
	
	/**
     * Relationship ASC ELSP
     */
    public function asc_elsp_travel_indent_records()
    {
        return $this->hasMany('App\Models\AscElspTravelIndentRecord', 'bank_account_id');
    }
	
    public function llt_ltp_travel_indent_records()
    {
        return $this->hasMany('App\Models\LltLtpTravelIndentRecord', 'bank_account_id');
    }
    public function llt_vcp_travel_indent_records()
    {
        return $this->hasMany('App\Models\LltVcpTravelIndentRecord', 'bank_account_id');
    }
    public function ds_rm_travel_indent_records()
    {
        return $this->hasMany('App\Models\DsRmTravelIndentRecord', 'bank_account_id');
    }
    public function wep_fop_travel_indent_records()
    {
        return $this->hasMany('App\Models\WepFopTravelIndentRecord', 'bank_account_id');
    }
    public function wep_ttp_travel_indent_records()
    {
        return $this->hasMany('App\Models\WepTtpTravelIndentRecord', 'bank_account_id');
    }
    public function wep_ltp_travel_indent_records()
    {
        return $this->hasMany('App\Models\WepLtpTravelIndentRecord', 'bank_account_id');
    }
	
	public function ds_annual_program_travel_indent_records()
    {
        return $this->hasMany('App\Models\DsAnnualProgramTravelIndentRecord', 'bank_account_id');
    }	
	
	public function leap_fop_travel_indent_records()
    {
        return $this->hasMany('App\Models\LeapFopTravelIndentRecord', 'bank_account_id');
    }
	
	/**
     * Relationship CBC TTP
     */
    public function cbc_ttp_indent_records()
    {
        return $this->hasMany('App\Models\CbcTtpIndentRecord', 'bank_account_id');
    }
	
	public function ict_indent_records()
    {
        return $this->hasMany('App\Models\IctIndentRecord', 'bank_account_id');
    }
	
	public function al_indent_records()
    {
        return $this->hasMany('App\Models\AlIndentRecord', 'bank_account_id');
    }
	
	public function asc_indent_records()
    {
        return $this->hasMany('App\Models\AscIndentRecord', 'bank_account_id');
    }	
	
	public function wep_indent_records()
    {
        return $this->hasMany('App\Models\WepIndentRecord', 'bank_account_id');
    }	
	
	public function leap_indent_records()
    {
        return $this->hasMany('App\Models\LeapIndentRecord', 'bank_account_id');
    }	
	
	
	public function ict_bankmaster_records()
    {
        return $this->hasMany('App\Models\IctBankmasterRecord', 'bank_account_id');
    }
	
	public function al_bankmaster_records()
    {
        return $this->hasMany('App\Models\AlBankmasterRecord', 'bank_account_id');
    }
	
	public function asc_bankmaster_records()
    {
        return $this->hasMany('App\Models\AscBankmasterRecord', 'bank_account_id');
    }
	
	public function cdp_ttp_bankmaster_records()
    {
        return $this->hasMany('App\Models\CdpTtpBankmasterRecord', 'bank_account_id');
    }
	
	public function ict_osr_indent_records()
    {
        return $this->hasMany('App\Models\IctOsrIndentRecord', 'bank_account_id');
    }	
	
	public function ict_top_indent_records()
    {
        return $this->hasMany('App\Models\IctTopIndentRecord', 'bank_account_id');
    }	
	
	public function ict_fop_indent_records()
    {
        return $this->hasMany('App\Models\IctFopIndentRecord', 'bank_account_id');
    }
	
	public function al_fop_indent_records()
    {
        return $this->hasMany('App\Models\AlFopIndentRecord', 'bank_account_id');
    }	
	
	public function leap_fop_indent_records()
    {
        return $this->hasMany('App\Models\LeapFopIndentRecord', 'bank_account_id');
    }
	
	public function al_ttp_indent_records()
    {
        return $this->hasMany('App\Models\AlTtpIndentRecord', 'bank_account_id');
    }	
	
	public function cdp_pop_indent_records()
    {
        return $this->hasMany('App\Models\CdpPopIndentRecord', 'bank_account_id');
    }	
	public function asc_ltp_indent_records()
    {
        return $this->hasMany('App\Models\AscLtpIndentRecord', 'bank_account_id');
    }	
	public function asc_eltp_indent_records()
    {
        return $this->hasMany('App\Models\AscEltpIndentRecord', 'bank_account_id');
    }	
	public function asc_elsp_indent_records()
    {
        return $this->hasMany('App\Models\AscElspIndentRecord', 'bank_account_id');
    }	
	
	public function llt_ltp_indent_records()
    {
        return $this->hasMany('App\Models\LltLtpIndentRecord', 'bank_account_id');
    }	
	
	public function llt_tot_indent_records()
    {
        return $this->hasMany('App\Models\LltTotIndentRecord', 'bank_account_id');
    }	
	
	public function llt_vcp_indent_records()
    {
        return $this->hasMany('App\Models\LltVcpIndentRecord', 'bank_account_id');
    }	
	
	public function ds_rm_indent_records()
    {
        return $this->hasMany('App\Models\DsRmIndentRecord', 'bank_account_id');
    }	
	
	public function ds_vc_indent_records()
    {
        return $this->hasMany('App\Models\DsVcIndentRecord', 'bank_account_id');
    }	
	
	public function dp_bsvo_indent_records()
    {
        return $this->hasMany('App\Models\DpBsvoIndentRecord', 'bank_account_id');
    }	
	
	public function wep_fop_indent_records()
    {
        return $this->hasMany('App\Models\WepFopIndentRecord', 'bank_account_id');
    }	
	
	public function wep_ttp_indent_records()
    {
        return $this->hasMany('App\Models\WepTtpIndentRecord', 'bank_account_id');
    }	
	
	public function wep_ltp_indent_records()
    {
        return $this->hasMany('App\Models\WepLtpIndentRecord', 'bank_account_id');
    }	
	
	public function ds_annual_program_indent_records()
    {
        return $this->hasMany('App\Models\DsAnnualProgramIndentRecord', 'bank_account_id');
    }	
	
	public function wep_cg_indent_records()
    {
        return $this->hasMany('App\Models\WepCgIndentRecord', 'bank_account_id');
    }	
	
	public function relief_indent_records()
    {
        return $this->hasMany('App\Models\ReliefIndentRecord', 'bank_account_id');
    }	
	
	public function admin_indent_records()
    {
        return $this->hasMany('App\Models\AdminIndentRecord', 'bank_account_id');
    }
   /**
     * Relationship Llt Partner
     */
  
	public function llt_partners()
    {
        return $this->belongsToMany('App\Models\LltPartner')->withPivot('invalid');
    }
	
	
	/**
     * Relationship Llt Lay Leader
     */
   
   public function llt_lay_leaders()
    {
        return $this->belongsToMany('App\Models\LltLayLeader')->withPivot('invalid');
    }
	
	public function beneficiaries() {
		return [
			'persons',
			'vendors',
			'general_vendors',
			'users',
			'employees',
			'organizations',
			'llt_project_incharges',
		];
	}
	
	public function parent() {
		foreach ($this->beneficiaries() as $beneficiary) {
			$parent = $this->$beneficiary()->first();
			if ($parent) {
				return $parent;
			}
		}
	}
	
	public function getSbiType() {
		return ($this->bank_name == 'sbi') ? 'SBI' : 'NSBI';
	}
	
	public function isValid() {
		if ($this->status == 'invalid' || ($this->pivot && $this->pivot->invalid == 1)) {
			return false;
		}
		return true;
	}
	
	
	public function isUnlinked() {
		if ($this->pivot && $this->pivot->invalid == 1) {
			return true;
		}
	}
	
	public function invalidReason() {
		if ($this->status == 'invalid') {
			return 'Invalid ('.$this->comments.')';
		} else {
			return 'Removed (A/C doesnt belongs to Beneficiary)';
		}
	}
	
	public static function getBankAccount($account_no, $ifsc_code) {		
		return  self::where('account_no', $account_no)
					 ->where('ifsc_code', $ifsc_code)
					 ->first();		
	}	
	
	/*
	public function relations() {
		$relations =  [		
			'cbc_ttp_indent_records' => 'CBC TTP',
			'ict_indent_records' => 'ICT',
			'al_indent_records' => 'AL',
			'asc_indent_records' => 'ASC',
			'wep_indent_records' => 'WEP',
			'leap_indent_records' => 'LEAP',
			'relief_indent_records' => 'Relief',
			'admin_indent_records' => 'Non Program',
		];
		
		foreach (AppHelper::options('training_programs') as $department => $programs) {
			foreach ($programs as $program) {
				$programModel = ModelHelper::load($program);
				$name = $programModel->title();
				$relations[$program.'_indent_records'] = $name;
				
				if ($programModel->hasTravel()) {
					$relations[$program.'_travel_indent_records'] = $name .' Travel';					
				}
			}
		}
		
		return $relations;
	}
	*/
	
	public function bankmasters() {
		return [			
			'ict_bankmaster_records' => 'ICT Bankmaster',
			'al_bankmaster_records' => 'AL Bankmaster',
			'cdp_ttp_bankmaster_records' => 'CDP Bankmaster',
			'asc_bankmaster_records' => 'ASC Bankmaster',
		];
	}
	
	public function canEdit() {
		// indent
		foreach ($this->relations() as $k => $v) {
			$related = DB::table($k)->where('bank_account_id', $this->id)->whereIn('status', ['payment_released', 'payment_success','completed'])->first();
			if ($related) {
				return false;
			}
		}
		
		// Bankmaster
		foreach ($this->bankmasters() as $k => $v) {
			$related = DB::table($k)->where('bank_account_id', $this->id)->whereIn('status', ['online_creation', 'completed'])->first();
			if ($related) {
				return false;
			}
		}
		return true;
	}
	
	public function canEditBasic() {
		foreach ($this->relations() as $k => $v) {
			$related = DB::table($k)->where('bank_account_id', $this->id)->first();
			if ($related) {
				return false;
			}
		}
		return true;
	}	
	
	public function route() {
		return route('bank_account.view', $this->id);
	}
	public function indexRoute() {
		return route('bank_accounts');
	}	
}
