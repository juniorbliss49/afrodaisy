<?php

class notifyimagelike extends Eloquent{

	protected $table = 'notifyimagelike';

protected $fillable = array('NotId', 'imageid', 'user_id', 'sender_id', 'seen', 'date');

}