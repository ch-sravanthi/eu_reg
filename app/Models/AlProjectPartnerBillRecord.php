<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\Models\ProjectPartnerBillRecord;
use App\User;

use Illuminate\Notifications\Notifiable;
class AlProjectPartnerBillRecord extends ProjectPartnerBill
{	
	 use Notifiable;
	
	/**
     * Relationship  
     */
    public function project_bill()
    {
        return $this->belongsTo('App\Models\AlProjectPartnerBill', 'bill_id');
    }	
	
	 public function attachments()
    {
        return $this->hasMany('App\Models\AlProjectPartnerBillAttachment', 'bill_id');
    }
	
	
	
}