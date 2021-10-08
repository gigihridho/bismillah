<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipeKamar extends Model
{
    protected $table = 'tipe_kamars';

    protected $fillable = [
        'nama','foto','lantai','harga','ukuran'
    ];

    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }

    public function fasilitas()
    {
        return $this->belongsToMany('App\Fasilitas', 'detail_fasilitas')->withTimestamps();
    }
}
