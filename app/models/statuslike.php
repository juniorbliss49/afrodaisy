<?php

class statuslike extends Eloquent{

	protected $table = 'statuslike';

	protected $fillable = array('statusId', 'user_id', 'sender_id', 'date');

}