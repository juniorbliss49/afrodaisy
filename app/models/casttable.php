<?php

class casttable extends Eloquent{

	protected $table = 'casttable';
	protected $fillable = array('user_id', 'cast_id', 'castMethod', 'castStatus');

public function casting()
    {
        return $this->belongsTo('Casting');
    }

}

