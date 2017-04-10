<?php

class servicemarketplace extends Eloquent{

	protected $table = 'servicemarketplace';

public static $others_rules = [
	'title' => 'required',
	'description' => 'required',
	'country' => 'required',
	'location' => 'required',
	'price' => 'required|numeric'
	];


}

