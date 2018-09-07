<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $table = 'contents';
    
    protected $fillable = [
        'name',
        'desc',
        'id_catagory',
        'id_publisher'
    ];
    
    public function image()
    {
        return $this->hasOne('App\ContentImage');
    }
}
