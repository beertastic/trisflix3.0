<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'owner',
        'title',
        'slug',
        'expires_at',
        'pass',
    ];

    public function items() {
        return $this->hasMany(LinkItem::class);
    }

    public function file() {
        return $this->hasMany(MediaFile::class,  'media_id', 'id');
    }

}
