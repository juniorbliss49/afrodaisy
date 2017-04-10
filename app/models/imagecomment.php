<?php

class imagecomment extends Eloquent{

	protected $table = 'imagecomment';

	protected $fillable = array('imageid', 'user_id', 'comment', 'date');

}