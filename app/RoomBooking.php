<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomBooking extends Model
{
    protected $table = 'room_bookings';

    protected $fillable = [
        'user_id','room_id','photo_payment','order_date','total_price','duration','arrival_date','departure_date','status','kode'
    ];

    protected $hidden = [

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }
}
