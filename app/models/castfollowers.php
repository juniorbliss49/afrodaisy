<?php

class castfollowers extends Eloquent{

	protected $table = 'castfollowers';

	public function users()
	{
		return $this->belongsTo('User');
	}

}