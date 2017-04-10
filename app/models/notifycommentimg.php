<?php

class notifycommentimg extends Eloquent{

	protected $table = 'notifycommentimg';

	protected $fillable = array('NotId', 'commId', 'user_id', 'date');

}