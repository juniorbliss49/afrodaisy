<?php

class notificationtable extends Eloquent{

	protected $table = 'notificationtable';

protected $fillable = array('notify_id','user_id', 'rcv_id', 'seen', 'read', 'date', '	time');
}