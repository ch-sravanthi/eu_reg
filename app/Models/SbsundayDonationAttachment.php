<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\User;
use App\Models\DonationAttachment;
use Illuminate\Notifications\Notifiable;

class SbsundayDonationAttachment extends DonationAttachment
{	
	 use Notifiable;
	
	/**
     * Relationship  
     */
    public function donation_record()
    {
        return $this->belongsTo('App\Models\SbsundayDonationRecord', 'record_id');
    }
	
}