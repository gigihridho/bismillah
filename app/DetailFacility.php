<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailFacility extends Model
{
    protected $table = 'detail_facilities';

    protected $fillable = [
        'facility_id','room_id'
    ];

    protected $hidden = [

    ];
}
