<?php

namespace App\Livewire\Media\MovieAlt;

use App\Http\Controllers\ScanController;
use App\Models\MovieAlt;
use Livewire\Component;
use Livewire\WithPagination;

class MovieAltList extends Component
{
    use WithPagination;
    protected $queryString = ['keyword'];
    public $keyword = '';
    public $textInput = '';

    public function search()
    {
        $this->keyword = $this->textInput;
    }

    public function updateAlts()
    {
        $scan = new ScanController();
        $scan->refreshAlts();
    }

    public function render()
    {
        $movies = MovieAlt::orderBy('title', 'asc')
            ->where('title',  'like', '%'.$this->keyword.'%')
            ->paginate(5);
        return view('livewire.media.movie-alt.movie-alt-list', compact('movies'));
    }
}
