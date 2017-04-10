<?php

class notifyjob extends Eloquent{

	protected $table = 'notifyjob';

protected $fillable = array('job_id','user_id', 'status', 'date');
}