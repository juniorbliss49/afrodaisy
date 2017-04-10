<?php

class replylike extends Eloquent{

	protected $table = 'replylike';

protected $fillable = array('replyId', 'user_id', 'sender_id', 'date');

}