<?php

namespace App\Models;

use App\AppModel;
use App\Models\ProjectPartnerBill;
use Illuminate\Notifications\Notifiable;

class CdpTtpProjectPartnerBill extends ProjectPartnerBill
{
	 use Notifiable;
	

	public function project_incharge(){
        return $this->belongsTo('App\Models\CdpTtpProjectIncharge', 'project_incharge_id');
	}
	
	public function project(){
        return $this->belongsTo('App\Models\CdpTtpProject', 'project_id');
	}		
	
	
	/**
     * Relationship records
     */
    public function records()
    {
        return $this->hasMany('App\Models\CdpTtpProjectPartnerBillRecord', 'bill_id');
    }
	
	public function beneficary() {
		if ($this->project_incharge_id) {
			return $this->project_incharge;
		}
	}
	
	public function title(){
		return 'Cdp Ttp FT BILLS' ;
	}
	
}

?>

