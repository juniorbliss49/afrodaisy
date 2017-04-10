<?php

class notifybirthdaystatus extends Eloquent{

	protected $table = 'notifybirthdaystatus';

protected $fillable = array('NotId','Birthid', 'user_id', 'date');
}