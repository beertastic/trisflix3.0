<?php

namespace App\Livewire\Media\TV;

use App\Http\Controllers\ScanController;
use App\Models\MediaPath;
use App\Models\Tv;
use Livewire\Component;

class TvView extends Component
{
    public $id;
    public $title;
    public $file_id = [];
    public $link_id;

    public function mount($id)
    {
        $ai = Tv::findOrFail($id);
        $this->title = $ai->title;
        $this->id = $ai->id;
    }

    public function indexShow()
    {
        $scan = new ScanController();
        $scan->indexPath($this->id, 'tv');
        $scan->indexTv($this->id, 'tv');
    }

    public function render()
    {
        $paths = MediaPath::where('media_id', $this->id)->where('media', 'tv')->get();
//        if ($paths->count() == 0) {
//            $scan = new ScanController();
//            $scan->indexTv($this->id);
//            $paths = MediaPath::where('media_id', $this->id)->where('media', 'movie')->get();
//        }
        return view('livewire.media.tv.tv-view', compact('paths'));
    }
}
