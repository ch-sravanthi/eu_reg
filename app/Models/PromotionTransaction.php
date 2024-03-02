<?php

namespace App\Models;

use App\AppModel;
use App\Models\Transaction;
use Illuminate\Notifications\Notifiable;

class PromotionTransaction extends Transaction
{
	 use Notifiable;
	 
	 protected $table = 'transactions'; 
	 
	/**
     * Relationship records
     */
     public function records()
    {
        return $this->hasMany('App\Models\PromotionTransactionRecord', 'transaction_id');
    }
	
	public function title(){
		return 'Donation' ;
	}
	
}

?>

