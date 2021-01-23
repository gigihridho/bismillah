<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';

    protected $fillable = [
        'name','icon',
    ];

    protected $hidden = [

    ];

    public function room_types(){
        return $this->belongsToMany(RoomType::class,'facility_room_type')->withTimestamps();
    }
}
