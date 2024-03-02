<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\Models\DonationRecord;
use App\User;

use Illuminate\Notifications\Notifiable;
class PromotionDonationRecord extends DonationRecord
{	
	 use Notifiable;
	
	protected $table = 'donation_records'; 
	
	/**
     * Relationship  
     */
    public function donation()
    {
        return $this->belongsTo('App\Models\PromotionDonation', 'donation_id');
    }	
	
	// Removing multiple attachments with a conclusion that there can be only one attachment per transaction.
	
	/* public function attachments()
    {
        return $this->hasMany('App\Models\MagazineDonationAttachment', 'donation_id');
    }*/	
	
}