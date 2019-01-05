<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasContent extends Model
{
    //
    protected $table = 'content_user';
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    
    public function contents()
    {
        return $this->hasMany('App\Content');
    }
}
