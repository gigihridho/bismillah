<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';

    protected $fillable = [
        'review','user_id'
    ];

    protected $hidden = [

    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
