<?php

class notifyreplylike extends Eloquent{

	protected $table = 'notifyreplylike';

protected $fillable = array('NotId' ,'replyId', 'user_id', 'sender_id', 'seen', 'date');

}