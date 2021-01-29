<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'name','status','room_type_id', 'slug'
    ];

    protected $hidden = [

    ];

    public function room_type(){
        return $this->belongsTo(RoomType::class,'room_type_id','id');
    }

    public function transactions(){
        return $this->hasOne(RoomBooking::class,'id','transaction_id');
    }
}
