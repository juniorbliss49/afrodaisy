<?php

class notifyreplycomment extends Eloquent{

	protected $table = 'notifyreplycomment';

	protected $fillable = array('NotId', 'replyId', 'user_id', 'sender_id', 'date');

}