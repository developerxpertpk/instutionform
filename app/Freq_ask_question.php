<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Freq_ask_question extends Model
{
    //

    protected $fillable = [
        'question','answer','status'
    ];

    protected $hidden = [
        'remember_token',
    ];
}
