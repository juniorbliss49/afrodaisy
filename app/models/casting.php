<?php

class Casting extends Eloquent{

	protected $table = 'casting';

	public static $cast_rules = [
		'title' => 'required',
	'casting' => 'required',
	'categories' => 'required',
	'gender' => 'required',
	'paymethod' => 'required',
	'location' => 'required',
	'venue' => 'required',
	'startDate' => 'required',
	'endDate' => 'required',
	'expDate' => 'required',
	'image'=>'image|mimes:jpeg,jpg,png,gif'
];

	public static $cast_update = [
		'castTitle' => 'required',
	'castDescription' => 'required',
	'payType' => 'required',
	'payDesc' => 'required',
	'location' => 'required',
	'area' => 'required',
	'image'=>'image|mimes:jpeg,jpg,png,gif'
];

public function users()
    {
        return $this->belongsTo('User');
    }

public function casttable()
	{
		return $this->hasMany('casttable');
	}

}

