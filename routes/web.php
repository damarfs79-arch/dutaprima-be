<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/artisan/storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');
    
    if (file_exists($link)) {
        return 'The "public/storage" directory already exists.';
    }
    
    app()->make('files')->link($target, $link);
    
    return 'The [public/storage] directory has been linked.';
});
