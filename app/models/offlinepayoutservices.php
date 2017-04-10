<?php

class offlinepayoutservices extends Eloquent{

	protected $table = 'offlinepayoutservices';
protected $fillable = array('service_id','amount', 'user_id', 'ref_id');

}
