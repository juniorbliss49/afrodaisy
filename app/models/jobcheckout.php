<?php

class jobcheckout extends Eloquent{

	protected $table = 'jobcheckout';

protected $fillable = array('job_id', 'user_id', 'paidstatus');


}

