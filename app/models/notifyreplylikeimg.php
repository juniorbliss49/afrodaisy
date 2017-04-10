<?php

class notifyreplylikeimg extends Eloquent{

	protected $table = 'notifyreplylikeimg';

protected $fillable = array('NotId' ,'replyId', 'user_id', 'sender_id', 'seen', 'date');

}