<?php

class replycomment extends Eloquent{

	protected $table = 'replycomment';

	protected $fillable = array('commentId', 'commsg', 'user_id', 'date');

}