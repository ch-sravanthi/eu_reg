<?php 
namespace App\Models;

use App\Models\ProjectIncharge;

class AlProjectIncharge extends ProjectIncharge{
	
	/**
     * Relationship AL Project
     */
    public function project()
    {
        return $this->belongsTo('App\Models\AlProject');
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
        return $this->hasMany('App\Models\AlBankmasterRecord', 'project_incharge_id');
    }
	
	/**
     * Relationship Payment
     */
	public function payments()
    {
        return $this->hasMany('App\Models\AlProjectPayment', 'project_incharge_id');
    }
    
	/**
     * Relationship AL FOP
     */
    public function al_fop()
    {
        return $this->hasOne('App\Models\AlFopParticipant', 'participant_id');
    }
	
	/**
     * Relationship AL TTP
     */
    public function al_ttp()
    {
        return $this->hasOne('App\Models\AlTtpParticipant', 'project_incharge_id');
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
        return $this->hasMany('App\Models\Ia\IaAlVisit', 'project_incharge_id');
    }
	
	/**
     * Relationship Project bills
     */
	public function project_bills()
    {
        return $this->hasMany('App\Models\AlProjectPartnerBill', 'project_incharge_id');
    }
	
	public function relations() {
		return [
			'person' => ['belongsTo', Person::class],
		];		
	}
	
	public function programs() {
		return [
			'al_fop' => 'AL FOP',
			'al_ttp' => 'AL TTP',
		];
	}
}
