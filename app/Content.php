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
    
    public function file()
    {
        return $this->hasOne('App\ContentFile');
    }
    
    public function media()
    {
        return $this->hasMany('App\ContentMedia');
    }
    
    public function publisher()
    {
        return $this->hasOne('App\Publisher');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    
    public function catagory()
    {
        return $this->belongsTo('App\Catagory');
    }
    
     public function age()
    {
//         if($this->low_age<7)
//             return$this->belongsTo('App\Catagory');
//        return static::where('low_age', '>=' ,7)->where('high_age', '<=' ,7)->get();
    }
    
}
