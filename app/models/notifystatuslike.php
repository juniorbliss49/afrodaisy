<?php

class notifystatuslike extends Eloquent{

	protected $table = 'notifystatuslike';

protected $fillable = array('NotId', 'statusId', 'user_id', 'sender_id', 'seen', 'date');

}