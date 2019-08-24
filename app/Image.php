<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   protected static function boot() {
        parent::boot();

        static::deleting(function($image) { // before delete() method call this
            $image->image_note()->delete();
            $image->delete();
        });
    }
    function task()
    {
        return $this->belongsTo(Task::class);
    }
    function image_note()
    {
        return $this->hasMany(ImageNote::class);
    }
}
