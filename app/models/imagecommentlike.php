<?php

class Imagecommentlike extends Eloquent{

	protected $table = 'imagecommentlike';

protected $fillable = array('commId', 'user_id', 'sender_id', 'date');

}