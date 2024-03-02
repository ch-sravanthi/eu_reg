<?php
namespace App\Models;

use App\Models\ProjectIncharge;
use App\Models\CdpTtpDonation;

class CdpTtpProjectIncharge extends ProjectIncharge
{ 
	/**
     * Get the project that owns the project incharge.
     */
    public function project()
    {
        return $this->belongsTo('App\Models\CdpTtpProject', 'project_id');
    }
	
	/**
     * Get the bankmaster records for the project incharge.
     */
	public function bankmaster_records()
    {
        return $this->hasMany('App\Models\CdpTtpBankmasterRecord', 'project_incharge_id');
    }

	/**
     * Get the cdp pop for the project incharge.
     */
    public function cdp_pop()
    {
        return $this->hasOne('App\Models\CdpPopParticipant', 'participant_id');
    }
	
    public function new_cdp_pop()
    {
        return $this->hasOne('App\Models\NewCdpPopParticipant', 'project_incharge_id');
    }


	/**
     * Get the programs of project incharge
	 *
	 * @return Array
     */
	public function programs() {
		return [
			//'cbc_pop' => 'Cbc POP',
		];
	}
	
	/**
     * Relationship Payment
     */
	public function payments()
    {
        return $this->hasMany('App\Models\CdpTtpProjectPayment', 'project_incharge_id');
    }
	
	public function project_bills()
    {
        return $this->hasMany('App\Models\CdpTtpProjectPartnerBill', 'project_incharge_id');
    }
	
	public function relations() {
		return [
			'person' => ['belongsTo', Person::class],
		];		
	}
	
	public function getNameTypeAttribute()
    {
        return 'CDP Incharge';
    }	
	
	public function noOfTimesDonated() {
		$person_id = $this->person_id;
		$cdpTtpDonations = CdpTtpDonation::withAndWhereHas('project', function($q) use($person_id) {
								$q->whereHas('project_incharges', function($q) use($person_id) {
										$q->where('person_id', $person_id);
								});
							})->get();
		$yearWise = [];
		foreach ($cdpTtpDonations as $cdpTtpDonation) {
			$yearWise[$cdpTtpDonation->project->project_year] = 1;
		}
		return count($yearWise);
	}
}
