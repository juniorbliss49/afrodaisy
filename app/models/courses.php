<?php

class courses extends Eloquent{

	protected $table = 'courses';

public static $others_rules = [
	'title' => 'required',
	'duration' => 'required',
	'description' => 'required',
	'country' => 'required',
	'location' => 'required',
	'price' => 'required|numeric'
	];


}

