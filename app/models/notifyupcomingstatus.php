<?php

class notifyupcomingstatus extends Eloquent{

	protected $table = 'notifyupcomingstatus';

protected $fillable = array('NotId','upcomingId', 'user_id', 'date');
}