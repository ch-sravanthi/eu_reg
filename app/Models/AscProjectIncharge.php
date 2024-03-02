<?php 
namespace App\Models;

use App\Models\ProjectIncharge;

class AscProjectIncharge extends ProjectIncharge{
	/**
     * Relationship Asc Project
     */
    public function project()
    {
        return $this->belongsTo('App\Models\AscProject');
    }
	
	/**
     * Relationship Asc Ltp
     */
    public function asc_ltp()
    {
        return $this->hasOne('App\Models\AscLtpParticipant', 'project_incharge_id');
    }
	
	/**
     * Relationship New Asc Ltp
     */
    public function new_asc_ltp()
    {
        return $this->hasOne('App\Models\NewAscLtpParticipant', 'project_incharge_id');
    }
	
	/**
     * Relationship Asc ELtp
     */
    public function asc_eltp()
    {
        return $this->hasOne('App\Models\AscEltpParticipant', 'project_incharge_id');
    }
	
	/**
     * Relationship DSRM
     */
    public function ds_rm() {
        return $this->hasOne('App\Models\DsRmParticipant', 'asc_project_incharge_id');
    }
	
	
	public function bankmaster_records()
    {
        return $this->hasMany('App\Models\AscBankmasterRecord', 'project_incharge_id');
    }
	
	/**
     * Relationship Payment
     */
	public function payments()
    {
        return $this->hasMany('App\Models\AscProjectPayment', 'project_incharge_id');
    }
	
	/**
     * Relationship IA Visits
     */
	public function ia_visits()
    {
        return $this->hasMany('App\Models\Ia\IaAscVisit', 'project_incharge_id');
    }
	
	public function programs() {
		return [
			'asc_ltp' => 'ASC LTP',
			'asc_eltp' => 'ASC ELTP',
		];
	}
	
}