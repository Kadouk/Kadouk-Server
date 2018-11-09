<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasContent extends Model
{
    //
    protected $table = 'users_has_contents';
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    
    public function contents()
    {
        return $this->hasMany('App\Content');
    }
}
