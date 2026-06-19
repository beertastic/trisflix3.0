<?php

namespace App\Livewire\Media\Movie;

use App\Http\Controllers\ScanController;
use App\Models\MediaFile;
use App\Models\MediaPath;
use App\Models\Movie;
use Livewire\Component;
use Livewire\WithPagination;

class MovieList extends Component
{
    use WithPagination;

    public $search = '';

    public function updateMovies()
    {
        $scan = new ScanController();
        $scan->refreshMovies();
    }

    public function addToShare($movie_id)
    {
        $file_ids = [];
        $scan = new ScanController();
        $data = MediaPath::where('media_id', $movie_id)->first();

        if (!$data) {
            // no dir scan yet, do that first
            $scan->indexMovie($movie_id);
            $data = MediaPath::where('media_id', $movie_id)->first();
        }

        foreach ($data->files as $file) {
            $file_ids[] = $file->id;
        }
        $scan->additems($file_ids);
    }

    public function render()
    {
        $movies = Movie::orderBy('title', 'asc')
            ->where('title',  'like', '%'.$this->search.'%')
            ->paginate(5);
        return view('livewire.media.movie.movie-list', compact('movies'));
    }

}
