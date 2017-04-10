<?php

class advert extends Eloquent{

	protected $table = 'advert';
protected $fillable = array('user','advertname', 'duration', 'amount', 'month', 'year');

}
