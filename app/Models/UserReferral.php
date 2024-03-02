<?php
namespace App\Models;

use App\AppModelNew;
use Illuminate\Notifications\Notifiable;

class UserReferral extends AppModelNew
{	

	use Notifiable;
	
	
	 protected $fillable = [
        'user',
		'uid',
		'status',
		'created_at',
		'created_by'
    ];
	
	public function niceNames()
	{
		return[
			'user' => 'User',
			'uid' => 'UID',
			'created_at' => 'Created At',
			'created_by' => 'Created By',
			'status' => 'Status',
		];
	}
	
	public function getEmailAttribute() {
		return filter_var($this->user, FILTER_VALIDATE_EMAIL) ? $this->user : null;
	}
	
	public function getMobileAttribute() {
		return is_numeric($this->user) && ($this->user >= 6000000000 && $this->user <= 9999999999) ? $this->user : null;
	}
}
