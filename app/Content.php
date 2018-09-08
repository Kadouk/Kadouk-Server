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
        'catagory_id',
        'publisher_id'
    ];
    
    protected $hidden = [
        'catagory_id',
        'publisher_id',
        'created_at',
        'updated_at'
        
    ];
    
    public function image()
    {
        return $this->hasOne('App\ContentImage');
    }
}
