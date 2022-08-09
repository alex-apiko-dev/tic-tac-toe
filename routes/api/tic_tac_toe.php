<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', \Game\Presentation\Controllers\GetStatus::class);
