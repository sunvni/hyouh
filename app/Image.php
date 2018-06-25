<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   
    function task()
    {
        return $this->belongsTo(Task::class);
    }
    function image_note()
    {
        return $this->hasMany(ImageNote::class);
    }
}
