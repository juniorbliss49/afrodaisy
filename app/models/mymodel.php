<?php

class mymodel extends Eloquent{

	protected $table = 'mymodel';

protected $fillable = array('agent_id', 'model_id', 'status');

}