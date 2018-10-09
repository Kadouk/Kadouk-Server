<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    //
    protected $table = 'catagory';
    
    protected $fillable = [
        'name',
        'desc'
    ];
    
     public function content()
    {
        return $this->hasMany('App\Content');
    }
}
