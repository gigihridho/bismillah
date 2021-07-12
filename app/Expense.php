<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';

    protected $fillable = [
        'pengeluaran','date','nominal','status','keterangan'
    ];

    protected $hidden = [

    ];
}
