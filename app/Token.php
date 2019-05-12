<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    const EXPIRATION_TIME = 15; // minutes

    protected $fillable = [
        'code',
        'user_id',
    ];

    /**
     * Generate a new token for the given user.
     *
     * @param  User $user
     * @return $this
     */
    public static function generateFor(User $user)
    {
        static::where('user_id', $user->id)->delete();
        
        $min = pow(10, 4);
        $max = $min * 10 - 1;
        $code = mt_rand($min, $max);
        return static::create([
            'user_id' => $user->id,
            'code'   => $user->id . $code
        ]);
    }


  /**
     * Get the route key for implicit model binding.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'code';
    }

    /**
     * A token belongs to a registered user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        //$this->byCode($code);
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public static function byCode($code)
    {
        return static::where('code', $code)->first();
    }
}
