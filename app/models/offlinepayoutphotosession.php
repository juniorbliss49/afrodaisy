<?php

class offlinepayoutphotosession extends Eloquent{

	protected $table = 'offlinepayoutphotosession';
protected $fillable = array('photosession_id','amount', 'user_id', 'ref_id');

}
