<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment', 'image_id', 'user_id'
    ];

    public function image() {
        return $this->belongsTo(Image::class);
    }
}
