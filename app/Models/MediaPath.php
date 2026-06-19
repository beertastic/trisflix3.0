<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaPath extends Model
{

    protected $table = 'media_paths';

    protected $fillable = [
        'media',
        'media_id',
        'path'
    ];

    public function files() {
        return $this->hasMany(MediaFile::class, 'path_id', 'id');
    }

    public function show() {
        return $this->belongsTo(TV::class, 'media_id');
    }

    public function movie() {
        return $this->belongsTo(Movie::class, 'media_id');
    }
}
