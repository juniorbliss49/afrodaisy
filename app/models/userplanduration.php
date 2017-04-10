<?php

class userplanduration extends Eloquent{

	protected $table = 'userplanduration';
	protected $fillable = array('user_id', 'plan_id', 'startdate', 'durationFromDay', 'durationFromMonth', 'durationFromYear', 'durationToDay', 'durationToMonth', 'durationToYear', 'enddate');

}