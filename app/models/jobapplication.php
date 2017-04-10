<?php

class jobapplication extends Eloquent{

	protected $table = 'jobapplication';

protected $fillable = array('user_id', 'job_id', 'month', 'year');

}