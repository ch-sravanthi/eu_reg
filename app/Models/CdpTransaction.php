<?php

namespace App\Models;

use App\AppModel;
use App\Models\Transaction;
use Illuminate\Notifications\Notifiable;

class CdpTransaction extends Transaction
{
	 use Notifiable;
	 
	 protected $table = 'transactions'; 
	 
	/**
     * Relationship records
     */
     public function records()
    {
        return $this->hasMany('App\Models\CdpTransactionRecord', 'transaction_id');
    }
	
	public function title(){
		return 'Donation' ;
	}
	
}

?>

