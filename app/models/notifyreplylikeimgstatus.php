<?php

class notifyreplylikeimgstatus extends Eloquent{

	protected $table = 'notifyreplylikeimgstatus';

protected $fillable = array('NotId' ,'replyId', 'user_id', 'sender_id', 'seen', 'date');

}