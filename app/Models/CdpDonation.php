<?php

namespace App\Models;

use App\AppModel;
use App\Models\MinistryDonation;
use Illuminate\Notifications\Notifiable;

class CdpDonation extends MinistryDonation
{
	 use Notifiable;
	 
	/**
     * Relationship records
     */
     public function records()
    {
        return $this->hasMany('App\Models\CdpDonationRecord', 'donation_id');
    }
	
	public function title(){
		return 'CDP Donation' ;
	}
	
}

?>