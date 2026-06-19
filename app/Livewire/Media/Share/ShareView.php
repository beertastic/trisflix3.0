<?php

namespace App\Livewire\Media\Share;

use App\Models\Link;
use App\Models\LinkItem;
use Carbon\Carbon;
use Livewire\Component;

class ShareView extends Component
{
    public $link_id;

    public function mount($link_id)
    {
        $this->link_id = $link_id;
    }

    public function removeLinkItem($link_id)
    {
        LinkItem::destroy($link_id);
    }

    public function render()
    {
        $data = [];
        Link::where('expires_at', '<', Carbon::now())->delete();
        $link = Link::find($this->link_id);
        return view('livewire.media.share.share-view', compact('link'));
    }
}
