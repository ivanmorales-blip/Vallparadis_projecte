<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CenterController;
Route::get('/', function () {
    return view('welcome');
});

route::get('/altaCenter',[CenterController::class,"create"]);
