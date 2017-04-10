<?php

class replycommentimg extends Eloquent{

	protected $table = 'replycommentimg';

	protected $fillable = array('commentId', 'commsg', 'user_id', 'date');

}