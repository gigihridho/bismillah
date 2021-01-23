<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'room_galleries';

    protected $fillable = [
        'photos','room_id'
    ];

    protected $hidden = [

    ];

    public function room(){
        return $this->belongsTo(Room::class);
    }
}
