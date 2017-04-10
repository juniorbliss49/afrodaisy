<?php

class notifynews extends Eloquent{

	protected $table = 'notifynews';

	protected $fillable = array('NotId', 'statusId', 'user_id', 'date');

}