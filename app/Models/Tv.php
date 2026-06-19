<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tv extends Model
{
    protected $table = 'tv';

    protected $fillable = [
        'title'
    ];

    public function paths() {
        return $this->hasMany(MediaPath::class,  'id', 'media_id');
    }

    public function files() {
        return $this->hasManyThrough(MediaFile::class, MediaPath::class);
    }
}

