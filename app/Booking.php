<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = [
        'user_id','room_id','photo_payment','order_date','total_price','duration','arrival_date','departure_date','status'
    ];

    protected $hidden = [

    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }
}
