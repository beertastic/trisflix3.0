<?php

use App\Models\Link;

$shares = null;
if (session('link_id') !== null) {
    $shares = Link::with(['items' => function ($q) {
        $q->take(4)->orderBy('created_at', 'desc');
    }])->find(session('link_id'));
}

if($shares) {
    echo '<div>
    <h3>Recently added to "' . $shares->title . '"</h3>';
    foreach($shares->items as $i) {
        echo '<br />' . $i->file->filename;
    }
    echo '</div>';
}
