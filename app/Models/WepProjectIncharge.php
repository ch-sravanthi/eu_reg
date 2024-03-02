<?php 
namespace App\Models;

use App\Models\ProjectIncharge;

class WepProjectIncharge extends ProjectIncharge{
	
	/**
     * Relationship AL Project
     */
    public function project()
    {
        return $this->belongsTo('App\Models\WepProject');
    }
	
	/**
     * Relationship Personal File
     */
    public function person_file()
    {
        return $this->belongsTo('App\Models\PersonFile', 'declaration_copy');
    }
	
	public function bankmaster_records()
    {
        return $this->hasMany('App\Models\WepBankmasterRecord', 'project_incharge_id');
    }
	
	/**
     * Relationship Payment
     */
	public function payments()
    {
        return $this->hasMany('App\Models\WepProjectPayment', 'project_incharge_id');
    }
    
	/**
     * Relationship AL FOP
     */
    public function al_fop()
    {
        return $this->hasOne('App\Models\WepFopParticipant', 'participant_id');
    }
	
	/**
     * Relationship AL TTP
     */
    public function al_ttp()
    {
        return $this->hasOne('App\Models\WepTtpParticipant', 'project_incharge_id');
    }	
	
	/**
     * Relationship DSRM
     */
    public function ds_rm() {
        return $this->hasOne('App\Models\DsRmParticipant', 'al_project_incharge_id');
    }
	
	/**
     * Relationship IA Visits
     */
	public function ia_visits()
    {
        return $this->hasMany('App\Models\Ia\IaWepVisit', 'project_incharge_id');
    }
	
	/**
     * Relationship Project bills
     */
	public function project_bills()
    {
        return $this->hasMany('App\Models\WepProjectPartnerBill', 'project_incharge_id');
    }
	
	
	public function programs() {
		return [
			'al_fop' => 'WEP FOP',
			'al_ttp' => 'WEP TTP',
		];
	}
	public function relations() {
		return [
			'person' => ['belongsTo', Person::class],
		];		
	}
}
