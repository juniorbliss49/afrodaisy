<?php

class offlinepayoutcourses extends Eloquent{

	protected $table = 'offlinepayoutcourses';
protected $fillable = array('course_id','amount', 'user_id', 'ref_id');

}
