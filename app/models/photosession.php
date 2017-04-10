<?php

class photosession extends Eloquent{

	protected $table = 'photosession';

public static $others_rules = [
	'title' => 'required',
	'duration' => 'required',
	'description' => 'required',
	'country' => 'required',
	'location' => 'required',
	'price' => 'required|numeric'
	];


}

