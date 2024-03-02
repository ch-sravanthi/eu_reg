<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\Models\DonationRecord;
use App\User;

use Illuminate\Notifications\Notifiable;
class SbsundayDonationRecord extends DonationRecord
{	
	 use Notifiable;
	
	/**
     * Relationship  
     */
    public function donation()
    {
        return $this->belongsTo('App\Models\SbsundayDonation', 'donation_id');
    }	
	
	 public function attachments()
    {
        return $this->hasMany('App\Models\SbsundayDonationAttachment', 'donation_id');
    }	
	
}