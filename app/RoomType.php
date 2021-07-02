<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $table = 'room_types';

    protected $fillable = [
        'name','photo','floor','price','size','status','slug'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function facilities()
    {
        return $this->belongsToMany('App\Facility', 'detail_facilities')->withTimestamps();
    }
}
