<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Depsimon\Wallet\HasWallet;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasWallet;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'pass', 
        'phone', 
        'gender', 
        'birth',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
         /**
     * Retrieve a user by their phone number.
     *
     * @param  string $phone
     * @return $this
     */
    public static function byPhone($phone){
        return static::where('phone', $phone)->first();
    }
    
     /**
     * Retrieve a user by their phone number.
     *
     * @param  string $phone
     * @return $this
     */
    public function isActive(){
        if($this->active == 0){
            return false;
        }
        else{
            return true;
        }
    }
    
    public function id(){
        return $this->id;
    }
    
    public function contents()
    {
        return $this->belongsToMany('App\Content');
    }
}