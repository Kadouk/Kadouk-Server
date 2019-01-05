<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table = 'transactions';
    protected $fillable = [
        'user_id',
        'transaction_id',
        'status',
        'price'
    ];
}
