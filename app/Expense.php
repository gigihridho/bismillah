<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';

    protected $fillable = [
        'description','date','nominal','photo'
    ];

    protected $hidden = [

    ];
}
