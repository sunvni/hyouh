<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    function project()
    {
        return $this->belongsTo(Project::class);
    }
    function image()
    {
        return $this->hasMany(Image::class);
    }
}
