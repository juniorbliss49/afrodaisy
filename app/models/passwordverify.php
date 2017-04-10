<?php

class passwordverify extends Eloquent{

	protected $table = 'passwordverify';
	protected $fillable = array('user_id', 'code');

}

