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
        return $this->belongsTo(RoomType::class,'room_type_id','id');
    }

    public function room_bookings(){
        return $this->hasMany(Booking::class);
    }

    // public function user(){
    //     return $this->hasOne(User::class,'id','user_id');
    // }

}
