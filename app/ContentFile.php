<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentFile extends Model
{
    //
     protected $table = 'content_files';
    
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
