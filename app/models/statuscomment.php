<?php

class statuscomment extends Eloquent{

	protected $table = 'statuscomment';

	protected $fillable = array('statusId', 'user_id', 'comment', 'date');

}