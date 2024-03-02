<?php
namespace App;

use App\AppModelNew;

class User extends AppModelNew
{

   
	 protected $fillable = [
        'name',
		'email',
		'mobile',
    ];
	
	public function rules ()
	{
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
        ];
	}

	public function niceNames()
	{
		return[
			'name' => 'Full Name',
			'email' => 'Email',
			'mobile' => 'Mobile',
			'created_by' => 'Created By',
			'status' => 'Status',
		];
	}

    public static function auth() {
        return session('user');
    }
    
}
