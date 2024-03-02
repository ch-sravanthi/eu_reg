<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\Models\ProjectPartnerBillRecord;
use App\User;

use Illuminate\Notifications\Notifiable;
class WepProjectPartnerBillRecord extends ProjectPartnerBill
{	
	 use Notifiable;
	
	/**
     * Relationship  
     */
    public function project_bill()
    {
        return $this->belongsTo('App\Models\WepProjectPartnerBill', 'bill_id');
    }	
	
	 public function attachments()
    {
        return $this->hasMany('App\Models\WepProjectPartnerBillAttachment', 'bill_id');
    }
	
	
	
}