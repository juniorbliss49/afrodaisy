<?php

class castpreference extends Eloquent{

	protected $table = 'castpreference';
	protected $fillable = array('prefId', 'castId', 'preFrom', 'preTo', 'preVal');



}

