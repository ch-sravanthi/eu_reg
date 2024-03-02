<?php 
namespace App\Models;
//namespace App\Models;

use App\AppModel;
use App\Helpers\AppHelper;
use Auth;
use Illuminate\Notifications\Notifiable;

class PromotionDonor extends AppModel{	
	 use Notifiable;  
	protected $fillable = [
		'title',
		'full_name',
		'donor_type',
		'donor_frequency',
		'address',
		'pincode',
		'district',
		'state',
		'mobile',
		'alternate_mobile',
		'email',
		'alternate_email',
		'zone',
		'no_of_times_donated'
	];	
	
	public function rules ()
	{
        return [
			'title' => 'required',
            'full_name' => 'required',
            'address' => 'required',
            'district' => 'required',
            'state' => 'required',
			'mobile' => 'nullable|mobile|unique:promotion_donors,mobile',
			'alternate_mobile' => 'nullable|mobile',
			'email' => 'nullable|email',
			'alternate_email' => 'nullable|email',
			'pincode' => 'nullable|pincode',
			'zone' => 'required',
			'no_of_times_donated' => 'required',
        ];
	}
    
	public function niceNames()
    {
        return [			
			'title' => 'Title',
			'full_name' => 'Full Name',
			'donor_type' => 'Donor Type',
			'donor_frequency' => 'Donor Frequency',
			'address' => 'Address',
			'pincode' => 'Pin Code',
			'district' => 'District',	
			'state' => 'State',
			'mobile' => 'Mobile No.',
			'alternate_mobile' => 'Alternate Mobile No',
			'email' => 'Email Id',
			'alternate_email' => 'Alternate Email Id',
			'promotion_donor_label' => 'Promotion Donor',
			'zone' => 'Zone',
			'no_of_times_donated' => 'No of times Donated'
        ];
    }
	

	/**
     * Relationship Receipt
     */
    public function receipts()
    {
        return $this->hasMany('App\Models\Promotion\PromotionReceipt', 'donor_id');
    }
	
	/**
     * Relationship Call
     */
    public function calls()
    {
        return $this->hasMany('App\Models\Promotion\PromotionCall', 'donor_id');
    }
	
	/**
     * Relationship Prayer Request
     */
    public function prayer_requests()
    {
        return $this->hasMany('App\Models\Promotion\PromotionPrayerRequest', 'donor_id');
    }
	
	
	/**
     * Relationship Praise Points
     */
    public function praise_points()
    {
        return $this->hasMany('App\Models\Promotion\PromotionPraisePoint', 'donor_id');
    }
	
	/**
     * Relationship Proposed Dates
     */
    public function proposed_dates()
    {
        return $this->hasMany('App\Models\Promotion\PromotionProposedDate', 'donor_id');
    }
	
	
	/**
     * Relationship Contact
     */
    public function contacts()
    {
        return $this->hasMany('App\Models\Promotion\PromotionContact', 'donor_id');
    }
	
	/**
     * Relationship Communication
     */
    public function communications()
    {
        return $this->hasMany('App\Models\Promotion\PromotionCommunication', 'donor_id');
    }	
	
	/**
     * Relationship 
     */
    public function donations()
    {
        return $this->hasMany('App\Models\SbsundayDonation', 'donor_id');
    }	
	
	/**
     * Relationship 
     */
    public function magazine()
    {
        return $this->hasMany('App\Models\MagazineDonation', 'donor_id');
    }		
	
	/**
     * Relationship 
     */
    public function alldonations()
    {
        return $this->hasMany('App\Models\PromotionDonation', 'donor_id');
    }	
	
	/**
     * Relationship
    public function blessingboxdonations()
    {
        return $this->hasMany('App\Models\BlessingboxDonation', 'donor_id');
    }	
	
	/**
     * Relationship 
    public function generaldonations()
    {
        return $this->hasMany('App\Models\GeneralDonation', 'donor_id');
    }	
	
	/**
     * Relationship 
    public function aldonations()
    {
        return $this->hasMany('App\Models\AlGeneralDonation', 'donor_id');
    }	
	
	/**
     * Relationship 
    public function cdpdonations()
    {
        return $this->hasMany('App\Models\CdpGeneralDonation', 'donor_id');
    } 
     */	
	
	
	public function fullname() {
		return AppHelper::dropdown($this->title, 'titles') . '.' . $this->full_name;
	}
}