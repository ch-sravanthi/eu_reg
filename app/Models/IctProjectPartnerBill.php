<?php

namespace App\Models;

use App\AppModel;
use App\Models\ProjectPartnerBill;
use Illuminate\Notifications\Notifiable;

class IctProjectPartnerBill extends ProjectPartnerBill
{
	 use Notifiable;
	

	public function project_incharge(){
        return $this->belongsTo('App\Models\IctProjectIncharge', 'project_incharge_id');
	}
	
	public function project(){
        return $this->belongsTo('App\Models\IctProject', 'project_id');
	}
	
	
	public function settlement_records()
    {
        return $this->hasMany('App\Models\IctProjectBillSettlementRecord', 'bill_id');
    }
	
	/**
     * Relationship records
     */
    public function records()
    {
        return $this->hasMany('App\Models\IctProjectPartnerBillRecord', 'bill_id');
    }
	
	public function beneficary() {
		if ($this->project_incharge_id) {
			return $this->project_incharge;
		} elseif ($this->center_incharge_id) {
			return $this->center_incharge;
		}
	}
	
	public function title(){
		return 'ICT FT BILLS' ;
	}
	
}

?>

