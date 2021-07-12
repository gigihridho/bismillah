<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expense';

    protected $fillable = [
        'pengeluaran','nominal','status','keterangan'
    ];

    protected $hidden = [

    ];
}
