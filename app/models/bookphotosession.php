<?php

class bookphotosession extends Eloquent{

	protected $table = 'bookphotosession';
protected $fillable = array('photoid','user_id', 'status');

}

