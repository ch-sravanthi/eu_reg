<?php 
namespace App\Models;

use App\Models\ProjectIncharge;

class IctProjectIncharge extends ProjectIncharge{
	
	public function rules()
	{
		$parentRules = parent::rules();
		unset($parentRules['previous_exp']);
		
		return array_merge($parentRules, $this->thisRules());
	}
	
	public function thisRules()
	{
		return  [
			'min_exp' => 'required',
		];
	}
	
	/**
     * Relationship ICT Project
     */
    public function project()
    {
        return $this->belongsTo('App\Models\IctProject');
    }
	
	/**
     * Relationship Personal File
     */
    public function person_file()
    {
        return $this->belongsTo('App\Models\PersonFile', 'declaration_copy');
    }
	
	/**
     * Relationship Onsite Review
     */
    public function ict_osr() {
        return $this->hasOne('App\Models\IctOsrParticipant', 'participant_id');
    }
	
	/**
     * Relationship IA Visits
     */
	public function ia_visits()
    {
        return $this->hasMany('App\Models\Ia\IaIctVisit', 'project_incharge_id');
    }
	
	
	/**
     * Relationship Onsite Review
     */
    public function participant() {
        return $this->hasOne('App\Models\IctOsrParticipant', 'participant_id');
    }
	
	/**
     * Relationship FOP
     */
    public function ict_fop() {
        return $this->hasOne('App\Models\IctFopParticipant', 'participant_id');
    }
	
	/**
     * Relationship DSRM
     */
    public function ds_rm() {
        return $this->hasOne('App\Models\DsRmParticipant', 'ict_project_incharge_id');
    }
	
	public function bankmaster_records()
    {
        return $this->hasMany('App\Models\IctBankmasterRecord', 'project_incharge_id');
    }	
	
	/**
     * Relationship Payment
     */
	public function payments()
    {
        return $this->hasMany('App\Models\IctProjectPayment', 'project_incharge_id');
    }	
	
	public function programs() {
		return [
			'ict_osr' => 'ICT OSR',
			'ict_fop' => 'ICT FOP',
		];
	}
	public function relations() {
		return [
			'person' => ['belongsTo', Person::class],
		];		
	}
	
	
}
