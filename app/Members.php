<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    //
    protected $fillable = ['name', 'gender', 'phone', 'amount'];
}
