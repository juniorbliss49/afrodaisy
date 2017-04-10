<?php

class replylikeimg extends Eloquent{

	protected $table = 'replylikeimg';

protected $fillable = array('replyId', 'user_id', 'sender_id', 'date');

}