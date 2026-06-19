<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinkItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'link_id',
        'file_id'
    ];

    public function link() {
        return $this->belongsTo(Link::class);
    }

    public function file() {
        return $this->belongsTo(MediaFile::class, 'file_id', 'id')->withTrashed();
    }

    public function getDownloadsCountAttribute()
    {
//        return $this->hasMany(Download::class);
        return $this->hasMany(Download::class, 'link_id', 'id')->count();
    }
}
