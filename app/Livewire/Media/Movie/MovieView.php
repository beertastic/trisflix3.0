<?php

namespace App\Livewire\Media\Movie;

use AllowDynamicProperties;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ScanController;
use App\Models\Link;
use App\Models\MediaPath;
use App\Models\Movie;
use App\Models\Path;
use Livewire\Component;

#[AllowDynamicProperties] class MovieView extends Component
{
    public $id;
    public $title;
    public $file_id = [];
    public $link_id;

    public function mount($id)
    {
        $ai = Movie::findOrFail($id);
        $this->title = $ai->title;
        $this->id = $ai->id;
    }

    public function indexMovie()
    {
        $scan = new ScanController();
        $scan->indexMovie($this->id);
    }

    public function addSelectedFiles()
    {
        $scan = new ScanController();
        $scan->additems($this->file_id);
    }

    public function download($id)
    {
        $dl = new DownloadController();
        $dl->force($id);
    }

    public function isLinked($link, $file)
    {
        return $link == $file;
    }

    public function render()
    {
        $paths = MediaPath::where('media_id', $this->id)->where('media', 'movie')->get();
        if ($paths->count() == 0) {
            $scan = new ScanController();
            $scan->indexMovie($this->id);
            $paths = MediaPath::where('media_id', $this->id)->where('media', 'movie')->get();
        }
        return view('livewire.media.movie.movie-view', compact('paths'));
    }
}
