<?php

class notifycomment extends Eloquent{

	protected $table = 'notifycomment';

	protected $fillable = array('NotId', 'commId', 'user_id', 'date');

}