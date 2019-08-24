<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    
    protected static function boot() {
        parent::boot();

        static::deleting(function($task) { // before delete() method call this
             $task->image()->delete();
             // do the rest of the cleanup...
        });
    }
    function project()
    {
        return $this->belongsTo(Project::class);
    }
    function image()
    {
        return $this->hasMany(Image::class);
    }
}
