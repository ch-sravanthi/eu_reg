<?php

namespace App\Models;

use App\AppModel;
use App\Models\Donation;
use Illuminate\Notifications\Notifiable;

class PromotionDonation extends Donation
{
	 use Notifiable;
	 
	 protected $table = 'donations'; 
	 
	/**
     * Relationship records
     */
     public function records()
    {
        return $this->hasMany('App\Models\PromotionDonationRecord', 'donation_id');
    }
	
	public function title(){
		return 'Donation' ;
	}
	
}

?>

