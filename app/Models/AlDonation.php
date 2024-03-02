<?php

namespace App\Models;

use App\AppModel;
use App\Models\MinistryDonation;
use Illuminate\Notifications\Notifiable;

class AlDonation extends MinistryDonation
{
	 use Notifiable;
	 
	/**
     * Relationship records
     */
     public function records()
    {
        return $this->hasMany('App\Models\AlDonationRecord', 'donation_id');
    }
	
	public function title(){
		return 'AL Donation' ;
	}
	
}

?>