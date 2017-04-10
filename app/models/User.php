<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	public static $auth_rules = [
		'email' => 'required|email|unique:users',
		'password' => 'required',
		'user_type' => 'required'
	];

	
	public static $auth_login = [
		'email' => 'required|email',
		'password' => 'required',
	];

	public static $checkmail = [
		'newemail' => 'required|email|unique:users'
	];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function others()
	{
		# code...
		return $this->hasOne('Others');
	}

	public function newmodel()
	{
		# code...
		return $this->hasOne('NewModel');
	}
	public function photoupload()
	{
		# code...
		return $this->hasOne('photoupload');
	}

	public function Casting()
	{
		return $this->hasMany('Casting');
	}

	public function castmessage()
	{
		return $this->hasMany('castmessage');
	}
	public function castlikes()
	{
		return $this->hasMany('castlikes');
	}

	public function profiles()
    {
        return $this->hasMany('Profile');
    }


}
