<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\Models\TransactionRecord;
use App\User;

use Illuminate\Notifications\Notifiable;
class AlTransactionRecord extends TransactionRecord
{	
	 use Notifiable;
	
	protected $table = 'transaction_records'; 
	
	/**
     * Relationship  
     */
    public function transaction()
    {
        return $this->belongsTo('App\Models\AlTransaction', 'transaction_id');
    }
	
}