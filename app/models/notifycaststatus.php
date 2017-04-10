<?php

class notifycaststatus extends Eloquent{

	protected $table = 'notifycaststatus';

protected $fillable = array('cast_id','user_id', 'status', 'date', 'time');
}