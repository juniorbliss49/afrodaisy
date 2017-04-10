<?php

class castApplication extends Eloquent{

	protected $table = 'castapplication';

protected $fillable = array('user_id', 'cast_id', 'month', 'year');

}