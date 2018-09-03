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
        return static::create([
            'user_id' => $user->id,
            'code'   => $user->phone
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
        return $this->belongsTo(User::class);
    }
    
    public static function byCode($code)
    {
        return static::where('code', $code)->first();
    }
}
