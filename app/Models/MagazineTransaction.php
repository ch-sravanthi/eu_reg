<?php

namespace App\Models;

use App\AppModel;
use App\Models\Transaction;
use Illuminate\Notifications\Notifiable;

class MagazineTransaction extends Transaction
{
	 use Notifiable;
	 
	 protected $table = 'magazine_transactions'; 
	 
	/**
     * Relationship records
     */
     public function records()
    {
        return $this->hasMany('App\Models\MagazineTransactionRecord', 'transaction_id');
    }
	
	public function title(){
		return 'Donation' ;
	}
	
}

?>

