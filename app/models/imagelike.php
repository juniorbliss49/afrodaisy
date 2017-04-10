<?php

class imagelike extends Eloquent{

	protected $table = 'imagelike';

	protected $fillable = array('imageid', 'user_id', 'sender_id', 'date');

}