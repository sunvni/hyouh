<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageNote extends Model
{
    protected $table = 'image_note';
    function image()
    {
        return $this->belongsTo(Image::class);
    }
}
