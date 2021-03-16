<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $table = 'room_types';

    protected $fillable = [
        'name','photo','description','price','size','slug'
    ];

    protected $hidden = [

    ];

    public function room(){
        return $this->hasMany(Room::class);
    }

    public function facilities(){
        return $this->belongsToMany(Facility::class,'detail_facilities')->withTimestamps();
    }
}
