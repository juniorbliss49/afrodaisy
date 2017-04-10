<?php

class verificationtable extends Eloquent{

	protected $table = 'verificationtable';
	protected $fillable = array('user_id', 'social','mobile','email', 'verify');

}