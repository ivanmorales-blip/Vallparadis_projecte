<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\Projectes_comissionsController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/menu', function () {
    return view('menu');
})->name('menu');
Route::resource('centers', CenterController::class);
// Desactivar
Route::delete('/centers/{center}', [CenterController::class, 'destroy'])->name('centers.destroy');
// Activar
Route::patch('/centers/{center}/active', [CenterController::class, 'active'])->name('centers.active');
//profesional
Route::resource('profesional', ProfesionalController::class);
//projectes_comissions
Route::resource('projectes_comissions', Projectes_comissionsController::class);