<?php

namespace App\Livewire\Media\TV;

use App\Http\Controllers\ScanController;
use App\Models\MediaPath;
use App\Models\Tv;
use Livewire\Component;
use Livewire\WithPagination;

class TvList extends Component
{
    use WithPagination;

    public $search = '';


    public function updateTv()
    {
        $scan = new ScanController();
        $scan->refreshShows();
    }

    public function addToShare($tv_id)
    {
        $file_ids = [];
        $scan = new ScanController();
        $data = MediaPath::where('media_id', $tv_id)->first();

        if (!$data) {
            // no dir scan yet, do that first
            $scan->indexTv($tv_id);
            $data = MediaPath::where('media_id', $tv_id)->first();
        }

        foreach ($data->files as $file) {
            $file_ids[] = $file->id;
        }
        $scan->additems($file_ids);
    }

    public function asd()
    {
        $this->indexPath($media_id, 'tv');
        $this->indexFiles($media_id, 'tv');
    }

    public function render()
    {
        $tvs = Tv::orderBy('title', 'asc')
            ->where('title',  'like', '%'.$this->search.'%')
            ->paginate(5);
        return view('livewire.media.tv.tv-list', compact('tvs'));
    }
}
