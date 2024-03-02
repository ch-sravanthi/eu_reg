<?php 
namespace App\Models;

use App\AppModel;
use Auth;
use App\Auditable;
use App\Helpers\AppHelper;
use App\User;
use App\Models\DonationAttachment;
use Illuminate\Notifications\Notifiable;

class MagazineDonationAttachment extends DonationAttachment
{	
	 use Notifiable;
	
	protected $table = 'magazine_donation_attachments'; 
	
	public function rules()
	{
		

        return[		
			
			'attachment' => 'required|mimes:pdf,jpeg,jpg,png|max:2000',
			
        ];
	}
	
	/**
     * Relationship  
     */
    public function donation_record()
    {
        return $this->belongsTo('App\Models\MagazineDonationRecord', 'record_id');
    }
	
}