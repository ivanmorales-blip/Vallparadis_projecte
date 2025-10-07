<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\Projectes_comissionsController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('centers', CenterController::class);
Route::resource('profesional', ProfesionalController::class);
Route::resource('projectes_comissions', Projectes_comissionsController::class);