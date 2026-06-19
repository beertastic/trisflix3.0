<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $table = 'movies';

    protected $fillable = [
        'title'
    ];

    public function paths() {
        return $this->hasMany(MediaPath::class,  'media_id', 'id');
    }

    public function files() {
        return $this->hasManyThrough(
            MediaFile::class,
            MediaPath::class,
            'path_id',
            'media_id',
            'id',
            'id'
        );
    }
}
