<?php

class job extends Eloquent{

	protected $table = 'job';

	public static $job_rules = [
		'title' => 'required',
	'job_description' => 'required',
	'job_task' => 'required',
	'amount' => 'required',
	'venue' => 'required',
	'location' => 'required'
];


}

