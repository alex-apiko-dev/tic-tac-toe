<?php

use Illuminate\Support\Facades\Route;
use Game\Presentation\Controllers\{
    GetStatus,
    SetPiece
};

Route::get('/', GetStatus::class);
Route::post('{piece}', SetPiece::class);
