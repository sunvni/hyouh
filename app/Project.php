<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    function users()
    {
        return $this->belongsTo('App\User','project_manager');
    }

    
    function task()
    {
        return $this->hasMany('App\Task');
    }

}
