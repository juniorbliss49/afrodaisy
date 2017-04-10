<?php

class status extends Eloquent{

	protected $table = 'status';

	protected $fillable = array('user_id', 'status', 'date');

}