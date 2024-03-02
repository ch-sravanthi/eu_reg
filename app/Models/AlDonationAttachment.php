<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\User;
use App\Models\MinistryDonationAttachment;
use Illuminate\Notifications\Notifiable;

class AlDonationAttachment extends MinistryDonationAttachment
{	
	 use Notifiable;
	
	/**
     * Relationship  
     */
    public function donation_record()
    {
        return $this->belongsTo('App\Models\AlDonationRecord', 'record_id');
    }
}