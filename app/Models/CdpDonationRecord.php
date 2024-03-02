<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\Models\MinistryDonationRecord;
use App\User;

use Illuminate\Notifications\Notifiable;
class CdpDonationRecord extends MinistryDonationRecord
{	
	 use Notifiable;
	
	/**
     * Relationship  
     */
    public function donation()
    {
        return $this->belongsTo('App\Models\CdpDonation', 'donation_id');
    }	
	
	 public function attachments()
    {
        return $this->hasMany('App\Models\CdpDonationAttachment', 'donation_id');
    }
}