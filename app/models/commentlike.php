<?php

class commentlike extends Eloquent{

	protected $table = 'commentlike';

protected $fillable = array('commId', 'user_id', 'sender_id', 'date');

}