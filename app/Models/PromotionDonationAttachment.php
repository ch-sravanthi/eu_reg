<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\User;
use App\Models\DonationAttachment;
use Illuminate\Notifications\Notifiable;

class PromotionDonationAttachment extends DonationAttachment
{	
	 use Notifiable;
	
	protected $table = 'donation_attachments'; 
	
	/**
     * Relationship  
     */
    public function donation_record()
    {
        return $this->belongsTo('App\Models\PromotionDonationRecord', 'record_id');
    }
	
}