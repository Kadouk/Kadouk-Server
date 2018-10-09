<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    //
    protected $table = 'publishers';
    
    protected $fillable = [
        'phone',
        'ddress',
        'first_name',
        'last_name',
        'company_name'
    ];
    
     public function content()
    {
        return $this->hasMany('App\Content');
    }
}
