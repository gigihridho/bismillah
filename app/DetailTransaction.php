<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $table = 'detail_transactions';

    protected $fillable = [
        'transaction_id','facility_id'
    ];

    protected $hidden = [

    ];
}
