<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MediaFile extends Model
{
    use softDeletes;

    protected $table = 'media_files';

    protected $fillable = [
        'filename',
        'path_id'
    ];

    public function path() {
        return $this->belongsTo(MediaPath::class,  'path_id', 'id');
    }

    public function show() {
        return $this->hasOneThrough(
            TV::class,
            MediaPath::class,
            'id',
            'id',
            'path_id',
            'media_id');
    }

    public function movie() {
        return $this->hasOneThrough(
            Movie::class,
            MediaPath::class,
            'id',
            'id',
            'path_id',
            'media_id');
    }

    public function link()
    {
        return $this->hasOne(LinkItem::class, 'file_id', 'id');
    }

}
