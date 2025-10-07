<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\Projectes_comissionsController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/altaCenter',[CenterController::class,"create"]);
Route::post('/insertCenter',[CenterController::class,"store"])
    ->name("insertCenter");

Route::get('/altaProfesional',[CenterController::class,"create"]);
Route::post('/insertProfesional',[CenterController::class,"store"])
    ->name("insertProfesional");

Route::get('/altaProjectes_comissions',[CenterController::class,"create"]);
Route::post('/insertProjectes_comissions',[CenterController::class,"store"])
    ->name("insertProjectes_comissions");