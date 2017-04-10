<?php

class modelpreference extends Eloquent{

	protected $table = 'modelpreference';

protected $fillable = array('modelId', 'chest/bust', 'waist', 'hips', 'dress', 'jacket', 'collar', 'shoes', 'eyes', 'hair_color', 'ethnicity', 'languages', 'complexion', 'butt', 'Hair_type', 'qualification');

}