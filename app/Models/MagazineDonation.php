<?php

namespace App\Models;

use App\AppModel;
use App\Models\Donation;
use Illuminate\Notifications\Notifiable;

class MagazineDonation extends Donation
{
	 use Notifiable;
	
	protected $table = 'magazine_donations'; 
	 
	/**
     * Relationship records
     */
     public function records()
    {
        return $this->hasMany('App\Models\MagazineDonationRecord', 'donation_id');
    }
	
	public function title(){
		return 'P&D M Donation' ;
	}
	
}

?>