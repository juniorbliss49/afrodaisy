<?php

class notifystatus extends Eloquent{

	protected $table = 'notifystatus';

protected $fillable = array('NotId', 'statusId', 'user_id', 'date');

}