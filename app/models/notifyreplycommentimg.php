<?php

class notifyreplycommentimg extends Eloquent{

	protected $table = 'notifyreplycommentimg';

	protected $fillable = array('NotId', 'replyId', 'user_id', 'sender_id', 'date');

}