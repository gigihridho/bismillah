<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'room_type_id','room_number','status','availability'
    ];

    protected $hidden = [

    ];

    public function room_type(){
        return $this->belongsTo(RoomType::class);
    }

    public function room_bookings(){
        return $this->hasMany(RoomBooking::class);
    }

}
