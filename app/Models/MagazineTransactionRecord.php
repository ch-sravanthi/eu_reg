<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\Models\TransactionRecord;
use App\User;

use Illuminate\Notifications\Notifiable;
class MagazineTransactionRecord extends TransactionRecord
{	
	 use Notifiable;
	
	protected $table = 'magazine_transaction_records'; 
	
	/**
     * Relationship  
     */
    public function transaction()
    {
        return $this->belongsTo('App\Models\MagazineTransaction', 'transaction_id');
    }
	
}