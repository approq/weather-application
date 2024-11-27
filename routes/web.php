<?php

use Illuminate\Support\Facades\Route;

Route::get('/{vue?}', function () {
    return view('app');
})->where('vue', '[\/\w\.-]*');
