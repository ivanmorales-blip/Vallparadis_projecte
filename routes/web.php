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

Route::get('/altaProfesional',[ProfesionalController::class,"create"]);
Route::post('/insertProfesional',[ProfesionalController::class,"store"])
    ->name("insertProfesional");

Route::get('/altaProjectes_comissions',[Projectes_comissionsController::class,"create"]);
Route::post('/insertProjectes_comissions',[Projectes_comissionsController::class,"store"])
    ->name("insertProjectes_comissions");