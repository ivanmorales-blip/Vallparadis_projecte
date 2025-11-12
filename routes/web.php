<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\Projectes_comissionsController;
use App\Http\Controllers\ProjectesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\EvaluationController;
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
    Route::delete('/centers/{center}', [CenterController::class, 'destroy'])->name('centers.destroy');
    Route::patch('/centers/{center}/active', [CenterController::class, 'active'])->name('centers.active');

    // Profesional
    Route::resource('profesional', ProfesionalController::class);
    Route::delete('/profesional/{profesional}', [ProfesionalController::class, 'destroy'])->name('profesional.destroy');
    Route::patch('/profesional/{profesional}/active', [ProfesionalController::class, 'active'])->name('profesional.active');
    // ✅ Ruta añadida para mostrar la fitxa del profesional
    Route::get('/profesional/{profesional}', [ProfesionalController::class, 'show'])->name('profesional.show');

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
    Route::resource('tracking', TrackingController::class)->except(['destroy']);
    Route::delete('/tracking/{tracking}', [TrackingController::class, 'destroy'])->name('tracking.destroy');
    Route::patch('/tracking/{tracking}/active', [TrackingController::class, 'active'])->name('tracking.active');
    // Ruta opcional para preseleccionar un profesional
    Route::get('/tracking/create', [TrackingController::class, 'create'])->name('tracking.create');
    
    // Evaluation
    Route::resource('evaluation', EvaluationController::class);

    Route::patch('evaluation/{evaluation}/active', [EvaluationController::class, 'active'])->name('evaluation.active');

    Route::delete('evaluation/{evaluation}', [EvaluationController::class, 'destroy'])->name('evaluation.destroy');
    Route::resource('evaluation', EvaluationController::class)->except(['destroy']);
    Route::get('/evaluation/create', [EvaluationController::class, 'create'])->name('evaluation.create');


    // Trainings
    Route::resource('trainings', TrainingController::class);
    Route::delete('/trainings/{training}', [TrainingController::class, 'destroy'])->name('trainings.destroy');
    Route::patch('/trainings/{training}/active', [TrainingController::class, 'active'])->name('trainings.active');



Route::resource('evaluation', EvaluationController::class);
Route::get('/evaluation/{evaluation}/download', [EvaluationController::class, 'download'])->name('evaluation.download');
Route::get('/evaluation/{evaluation}/download', [App\Http\Controllers\EvaluationController::class, 'download'])
    ->name('evaluation.download');


    Route::get('/dashboard', function() {
    return redirect()->route('menu'); // O cualquier página que quieras

})->name('dashboard');


});

require __DIR__.'/auth.php';
