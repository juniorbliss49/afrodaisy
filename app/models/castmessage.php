<?php

class castmessage extends Eloquent{

	protected $table = 'castmessage';

	public function users()
	{
		return $this->belongsTo('User');
	}

}