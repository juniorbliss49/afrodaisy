<?php

class Catid extends Eloquent{

	protected $table = 'catinput';

protected $fillable = array('user_id', 'cat_id');


public function Category()
	{
		return $this->belongsTo('Category');
	}

}

