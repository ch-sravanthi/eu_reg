<?php

namespace App\Models;
 

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use \HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
use Illuminate\Notifications\Notifiable;
use App\Models\AccessControl;
use App\Helpers\AppHelper;
use App\Helpers\AttendanceHelper;
use App\Helpers\EmployeeHelper;
use Auth;

 
class User extends Model implements
	AuthenticatableContract,
	AuthorizableContract,
	CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, Notifiable, UsersOnlineTrait;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
		'mobile',
		'role',
        'status',
    ];
	public function rules() {
		$id = $this->id;
		//var_dump($id);die();
		return [
			'name' => 'required',
			//'email' => "required|unique:users,email,{$id},id,deleted_at,NULL",
			'email' => 'required|email',
			'mobile' => 'required',
			'role' => 'required',
		];
	}	
	public $nicenames =  [
		'name' => 'User Name',
		'email' => 'User Email Id',
		'mobile' => 'User Mobile Number',
		'role' => 'User Role',
		'password' => 'Password',
		'status' => 'User Status',
	];

	
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
	public function isAdmin()
	{die();
		return $this->role == 'Admin';
	}
	
	public function isSuperAdmin()
	{
		return $this->role=='Super Admin';
	}
	public function getPaginateAttribute()
	{
		return  8;
	}
	
	
}
