<?php

namespace App\Livewire\Media\Share;

use App\Models\Link;
use App\Models\LinkItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ShareList extends Component
{
    use WithPagination;
    protected $queryString = ['keyword'];
    public $keyword = '';
    public $textInput = '';
    public $title = '';

    public function search()
    {
        $this->keyword = $this->textInput;
    }

    public function createShare()
    {
        $share = Link::create([
            'owner' => auth()->user()->id,
            'slug' => Str::random(20),
            'title' => $this->title == '' ? auth()->user()->name . ' Share ' . rand(1,999) : $this->title,
            'expires_at' => now()->addDays(14),
            'pass' => Str::random(20)
        ]);

        session(['link_id' => $share->id]);
        session(['slug' => $share->slug]);
    }

    public function setShareActive($id)
    {
        $share = Link::find($id);
        session(['link_id' => $share->id]);
        session(['slug' => $share->slug]);
    }

    public function deleteShare($id)
    {
        Link::find($id)->delete();
        Session::forget('link_id');
        Session::forget('slug');
    }

    public function viewFiles($link_id)
    {
        return redirect()->route('shares.view', $link_id);
    }

    public function render()
    {
        $shares = Link::orderBy('created_at', 'asc')
            ->where('expires_at', '>', now())
            ->paginate(5);
        return view('livewire.media.share.share-list', compact('shares'));
    }
}
