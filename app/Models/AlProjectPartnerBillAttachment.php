<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\Models\ProjectPartnerBillRecord;
use App\User;

use Illuminate\Notifications\Notifiable;
class AlProjectPartnerBillAttachment extends ProjectPartnerBill
{	
	 use Notifiable;
	
	/**
     * Relationship  
     */
    public function project_bill_record()
    {
        return $this->belongsTo('App\Models\AlProjectPartnerBillRecord', 'record_id');
    }	
	
	
	
	
	
}