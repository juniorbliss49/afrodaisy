<?php

class castlikes extends Eloquent{

	protected $table = 'castlikes';

	public function users()
	{
		return $this->belongsTo('User');
	}

}