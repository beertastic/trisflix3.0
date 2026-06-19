<?php

namespace App\Http\Controllers;

use App\Models\Download;
use App\Models\File;
use App\Models\Link;
use App\Models\LinkItem;
use App\Models\MediaFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery\Exception;

class DownloadController extends Controller
{
    private $path_movies;
    private $path_tv;
    private $path_alts;
    private $path_temp;

    public function __construct() {
        $this->path_tv = config('trisflix.path_tv');
        $this->path_movies = config('trisflix.path_movies');
        $this->path_alts = config('trisflix.path_alts');
        $this->path_temp = config('trisflix.path_temp');
    }

    public function fetch($slug = null) {
        if ($slug === null) {
            throw new Exception('That Slug was not good');
        }
        $link = Link::where('slug', $slug)->first();

        if (!$link) {
            throw new Exception('That Slug was not good');
        }

        if ($link->expires_at < Carbon::now()->toDateTimeString()) {
            throw new Exception('Link expired');
        }

        if (!session('pass_' . $link->slug)) {
            return view('password', ['link' => $link]);
        }

        $data = [];
        $data['slug'] = $slug;
        $data['date_end'] = $link->expires_at;
        foreach($link->items as $file) {
            $data['files'][] = $file;
        }

        return view('download', $data);
    }

    public function login(Request $request, $slug) {
        $link = Link::where('slug', $slug)->first();
        if ($link->pass == $request->pass) {
            session(['pass_' . $slug => $slug]);
        }
        return redirect()->route('fetch', $slug);
    }

    public function download($slug, $link_id)
    {
        $link = LinkItem::find($link_id);
        if ($link->link->slug != $slug) {
            throw new Exception('That Slug was not good 3');
        }

        if (!session('pass_' . $slug)) {
            return view('password', ['link' => $link->link]);
        }

        $file = $link->file;
        if ($file->path->media == 'tv') {
            $path = $this->path_tv;
            $filePath = $path . $file->path->show->title . '/' . $file->path->path . '/' . $file->filename;
        } else if ($file->path->media == 'movie') {
            $path = $this->path_movies;
            $filePath = $path . $file->path->path . '/' . $file->filename;
        }

        $filemime = finfo_open(FILEINFO_MIME_TYPE);
        $headers = ['Content-Type: ' . finfo_file($filemime, $filePath)];

        $this->logDownload($file->id);

        return response()->download($filePath, $file->filename, $headers);
    }

    private function logDownload($link_id)
    {
        Download::create([
            'link_id' => $link_id,
            'ip_address' => $_SERVER["REMOTE_ADDR"]
        ]);
    }

    public function force($file_id = null)
    {
        $file = MediaFile::find($file_id);
        if ($file->path->media == 'tv') {
            $path = $this->path_tv;
            $filePath = $path . $file->path->show->title . '/' . $file->path->path . '/' . $file->filename;
        } else if ($file->path->media == 'movie') {
            $path = $this->path_movies;
            $filePath = $path  . '/' . $file->path->path . '/' . $file->filename;
        }

        $filemime = finfo_open(FILEINFO_MIME_TYPE);
        $headers = ['Content-Type: ' . finfo_file($filemime, $filePath)];

//        $this->logDownload($file->id);

        return response()->download($filePath, $file->filename, $headers);
    }
}
