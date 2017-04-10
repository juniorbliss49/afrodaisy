<?php
// 

class Profile extends Eloquent {

protected $table = 'profiles';

    public function user()
    {
        return $this->belongsTo('User');
    }
}

?>