<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentImage extends Model
{
    //
    protected $table = 'content_images';
    
    protected $fillable = [
        'content_id',
        'path'
    ];
}
