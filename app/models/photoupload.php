<?php

class photoupload extends Eloquent{

	public static $rules = [
		'image'=>'image|mimes:jpeg,jpg,png,gif',
		'category' => 'required'
	];

	public static $rules2 = [
		'image'=>'image|mimes:jpeg,jpg,png,gif'
	];

	protected $table = 'photoupload';

	public function users()
	{
		return $this->belongsTo('User');
	}

} 