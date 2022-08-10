<?php

use Illuminate\Support\Facades\Route;
use Game\Presentation\Controllers\{
    GetStatus,
    SetPiece,
    Restart
};

Route::get('/', GetStatus::class);
Route::post('restart', Restart::class);
Route::post('{piece}', SetPiece::class);
