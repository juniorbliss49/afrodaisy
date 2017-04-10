<?php

class Others extends Eloquent{

	protected $table = 'others';

public static $others_rule2 = [
	'Name' => 'required',
	'address' => 'required',
	'telephone' => 'required',
	'terms' => 'required',
	'location' => 'required',
	'country' => 'required',
	'industry' => 'required'
	];

public static $others_rules = [
	'Name' => 'required',
	'address' => 'required',
	'telephone' => 'required',
	'terms' => 'required',
	'location' => 'required',
	'country' => 'required'
	];


	public function users()
	{
		return $this->belongsTo('User');
	}

}

