<?php

use App\Livewire\Media\Movie\MovieList;
use App\Livewire\Media\Movie\MovieView;
use App\Livewire\Media\MovieAlt\MovieAltList;
use App\Livewire\Media\Share\ShareList;
use App\Livewire\Media\Share\ShareView;
use App\Livewire\Media\TV\TvList;
use App\Livewire\Media\TV\TvView;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::group(['prefix'=>'movies','as'=>'movies'], function () {
        Route::get('/', MovieList::class)->name('.index');
        Route::get('/{id}', MovieView::class)->name('.view');
    });
    Route::group(['prefix'=>'tv','as'=>'tv'], function () {
        Route::get('/', TvList::class)->name('.index');
        Route::get('/{id}', TvView::class)->name('.view');
    });
    Route::group(['prefix'=>'alts','as'=>'alts'], function () {
        Route::get('/', MovieAltList::class)->name('.index');
        Route::get('/{id}', MovieAltList::class)->name('.view');
    });
    Route::group(['prefix'=>'shares','as'=>'shares'], function () {
        Route::get('/', ShareList::class)->name('.index');
        Route::get('/{link_id}', ShareView::class)->name('.view');
    });

});

Route::get('/force/{file_id}',             [DownloadController::class, 'force'])->name('force');


require __DIR__.'/auth.php';
