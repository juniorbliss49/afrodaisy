<?php

class onlinepayoutservices extends Eloquent{

	protected $table = 'onlinepayoutservices';
protected $fillable = array('service_id','amount', 'user_id', 'ref_id');

} 
