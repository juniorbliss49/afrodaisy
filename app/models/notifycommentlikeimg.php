<?php

class notifycommentlikeimg extends Eloquent{

	protected $table = 'notifycommentlikeimg';

protected $fillable = array('NotId', 'commentId', 'user_id', 'sender_id', 'date', 'seen');

}