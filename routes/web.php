<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\Projectes_comissionsController;
use App\Http\Controllers\ProjectesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('auth.login');
});

// Dashboard (solo usuarios autenticados y verificados)
Route::get('/menu', function () {
    return view('menu');
})->middleware(['auth', 'verified'])->name('menu');


// Rutas que requieren autenticación
Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Menú
    Route::get('/menu', function () {
        return view('menu');
    })->name('menu');


    // Centers
    Route::resource('centers', CenterController::class);
    // Desactivar
    Route::delete('/centers/{center}', [CenterController::class, 'destroy'])->name('centers.destroy');
    // Activar
    Route::patch('/centers/{center}/active', [CenterController::class, 'active'])->name('centers.active');

    // Profesional
    Route::resource('profesional', ProfesionalController::class);
    // Desactivar
    Route::delete('/profesional/{profesional}', [ProfesionalController::class, 'destroy'])->name('profesional.destroy');
    // Activar
    Route::patch('/profesional/{profesional}/active', [ProfesionalController::class, 'active'])->name('profesional.active');

    // Projectes Comissions
    Route::resource('projectes_comissions', Projectes_comissionsController::class);

    Route::patch('projectes_comissions/{projectes_comissions}/active', [Projectes_comissionsController::class, 'active'])->name('projectes_comissions.active');

    Route::delete('projectes_comissions/{projectes_comissions}', [Projectes_comissionsController::class, 'destroy'])->name('projectes_comissions.destroy');

    // AJAX activate route
    Route::get('projectes_comissions/{projectes_comissions}/active', [Projectes_comissionsController::class, 'active']);

    // Activació taquilles
    Route::get('/export/taquilla', [ExportController::class, 'exportTaquilla'])->name('export.taquilla');
    Route::get('/export/uniform', [ExportController::class, 'exportUniform'])->name('export.uniform');

    // Seguiment
    Route::resource('tracking', TrackingController::class);
    // Desactivar
    Route::delete('/tracking/{tracking}', [TrackingController::class, 'destroy'])->name('tracking.destroy');
    // Activar
    Route::patch('/tracking/{tracking}/active', [TrackingController::class, 'active'])->name('tracking.active');


});

require __DIR__.'/auth.php';
