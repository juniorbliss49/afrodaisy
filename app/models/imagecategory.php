<?php

class imagecategory extends Eloquent{

	protected $table = 'imagecategory';

	protected $fillable = array('user_id', 'imageid', 'disid');

}