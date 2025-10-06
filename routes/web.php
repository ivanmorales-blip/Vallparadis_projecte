<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CenterController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/altaCenter',[CenterController::class,"create"]);
Route::post('/insertCenter',[CenterController::class,"store"])
    ->name("insertCenter");
