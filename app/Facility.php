<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';

    protected $fillable = [
        'name','icon', 'slug',
    ];

    protected $hidden = [

    ];

    public function room(){
        return $this->hasMany(Room::class);
    }

    public function room_types(){
        return $this->belongsToMany(RoomType::class,'detail_facilities')->withTimestamps();
    }
}
