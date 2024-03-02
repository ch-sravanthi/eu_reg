<?php 
namespace App\Models;

use App\Models\CenterIncharge;
use App\Models\Person;
use App\AppModel;
use App\Auditable;

class WepCenterIncharge extends CenterIncharge{

	use Auditable;
	
	public $fillable = [
		'review_status'
	];
	public function rules()
	{
		//return array_merge(parent::rules(), $this->thisRules());
		$person = $this->person ? $this->person : new Person;
		return  $person->rules();
	}

	
	public function all_rules()
	{
		return array_merge(parent::rules(), $this->thisRules(), $this->mapRules());
	}
	
	public function thisRules()
	{	return  [			
           // 'location' => 'required',
          //  'location_latlong' => 'required',
			
		];
	}
	
	public function mapRules()
		{
			return  [			
			   'location' => 'required',
			   'location_latlong' => 'required',
				
		];
	}
	public function niceNames()
	{
		return[			
			'status' => 'Status',
			'review_status' => 'Review Status',
			'code' => 'Assistant Code',		
			'status_details' => 'Status',
			'assistant_details' => 'Assistant Details',
            'location' => 'Location of the Center',
			'location_latlong' => 'Latitude & Longitude',
            'people_group' => 'People Group',
			'photo' => 'Photo',
			'address_proof_copy' => 'Address Proof Copy',
			'testimony_copy' => 'Testimony Copy',
            'declaration_copy' => 'Declaration Copy',
            'dec_copy' => 'Declaration Copy',
            'application_copy' => 'Profile Copy',
			
			'location_label' => 'Center Location',
			'advisors_label' => 'Village Advisors',
			'full_name' => 'Assistant Name',
		     'replacement_id' => 'Replace With',
		];
	}
	
	/**
     * Relationship Project
     */
    public function project()
    {
        return $this->belongsTo('App\Models\WepProject');
    }
	
	
    public function replacement()
    {
        return $this->hasOne('App\Models\WepCenterIncharge', 'replacement_id');
    }
	
    public function parent()
    {
        return $this->belongsTo('App\Models\WepCenterIncharge', 'replacement_id');
    }
	
	public function bankmaster_records()
    {
        return $this->hasMany('App\Models\WepBankmasterRecord', 'wep_center_incharge_id');
    }
	
	public function title()
	{
		return 'WE Assistants';
	}
	public function payments()
    {
        return $this->hasMany('App\Models\WepProjectPayment', 'wep_center_incharge_id');
    }
	
	public function getNameTypeAttribute()
    {
        return 'Wep Assistant';
    }	
	public function prayer_requests()
    {
        return $this->hasMany('App\Models\WepPrayerRequest', 'center_incharge_id');
	}
	
	public function praise_points()
    {
        return $this->hasMany('App\Models\WepPraisePoint', 'center_incharge_id');
	}
	
	public function type() {
		return 'wep_center_incharge';
	}

	public function incharge_name(){
		return $this->person->fullname();
	}
	/**
     * Relation Logs
     */
    public function logs() {
		$class = new class extends \App\Audit{ protected $table = 'wep_center_incharge_logs';};
        return $this->hasMany(get_class($class), 'parent_id');		
	}
}