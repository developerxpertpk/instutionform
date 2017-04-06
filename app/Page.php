<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //

    protected $fillable = [
        'content_type', 'title','slug','content'
    ];
}
