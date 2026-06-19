<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieAlt extends Model
{
    protected $table = 'movie_alts';

    protected $fillable = [
        'title'
    ];
}
