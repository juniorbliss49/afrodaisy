<?php

class NewModel extends Eloquent{

	protected $table = 'models';

public static $model_rules = [
	'firstName' => 'required',
	'lastName' => 'required',
	'displayName' => 'required|min:6|unique:models',
	'phone' => 'required',
	'DayofBirth' => 'required',
	'MonthofBirth' => 'required',
	'YearofBirth' => 'required',
	'location' => 'required',
	'country' => 'required',
	'about' => 'required',
	'gender' => 'required',
	'Height' => 'required',
	'cat' => 'required',
	'terms' => 'required'
	];

public static $editusers = [
	'firstName' => 'required',
	'lastName' => 'required',
	'displayName' => 'required|min:6',
	'phone' => 'required',
	'location' => 'required',
	'country' => 'required',
	'about' => 'required',
	'gender' => 'required',
	'Height' => 'required',
	];

public static $email_rules = [
	'email' => 'required|email'
];

public static $password_rules = [
	'password' => 'required',
	'retype' => 'required|same:password'
];

public static $contact = [
	'email' => 'required|email',
	'contactus' => 'required',
	'Name' => 'required'
];


	public function users()
	{
		return $this->belongsTo('User');
	}

}

