<?php

use Illuminate\Support\Facades\Route;
use Intervention\Image\Laravel\Facades\Image;

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

