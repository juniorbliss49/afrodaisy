<?php

class notifymessage extends Eloquent{

	protected $table = 'notifymessage';

protected $fillable = array('NotId', 'user_id', 'date');

}