<?php

class notifycommentlike extends Eloquent{

	protected $table = 'notifycommentlike';

protected $fillable = array('NotId', 'commentId', 'user_id', 'sender_id', 'date', 'seen');

}