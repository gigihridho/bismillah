<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $table = 'detail_transactions';

    protected $fillable = [
        'transaction_id','user_id'
    ];

    protected $hidden = [

    ];
}
