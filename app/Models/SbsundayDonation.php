<?php

namespace App\Models;

use App\AppModel;
use App\Models\Donation;
use Illuminate\Notifications\Notifiable;

class SbsundayDonation extends Donation
{
	 use Notifiable;
	 
	/**
     * Relationship records
     */
     public function records()
    {
        return $this->hasMany('App\Models\SbsundayDonationRecord', 'donation_id');
    }
	
	public function title(){
		return 'SB Sunday Donation' ;
	}
	
}

?>