<?php

class jobpayment extends Eloquent{

	protected $table = 'jobpayment';

	public static $rules = [
	'user_id' => 'required'
	];

protected $fillable = array('job_id', 'user_id', 'amount');

}