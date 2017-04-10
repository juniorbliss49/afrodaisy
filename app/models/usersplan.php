<?php

class usersplan extends Eloquent{

	protected $table = 'usersplan';
	protected $fillable = array('user_id', 'plan_id','status');

}