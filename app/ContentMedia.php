<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentMedia extends Model
{
    //
     protected $table = 'content_medias';
    
    protected $fillable = [
        'content_id',
        'path'
    ];
    
    protected $hidden = [
        'content_id',
        'created_at',
        'updated_at',
        'id'
        
    ];
}
