<?php

class randomnumber extends Eloquent{

	protected $table = 'randomnumber';

	protected $fillable = array('user_id', 'number', 'verify');

}