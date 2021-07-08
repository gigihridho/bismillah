<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';

    protected $fillable = [
        'name', 'status'
    ];

    protected $hidden = [

    ];

    public function room_types(){
        return $this->belongsToMany('App\RoomType','detail_facilities')->withTimestamps();
    }
}
