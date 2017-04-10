<?php

class emailverification extends Eloquent{

	protected $table = 'emailverification';
	protected $fillable = array('user_id', 'code');

}

