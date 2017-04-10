<?php

class castpayment extends Eloquent{

	protected $table = 'castpayment';

	public static $rules = [
	'model_id' => 'required'
	];

protected $fillable = array('cast_id', 'user_id', 'amount');

}