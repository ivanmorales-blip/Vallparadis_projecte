<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\Projectes_comissionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\EvaluationController;
use Illuminate\Support\Facades\Route;

// Ruta de login
Route::get('/', function () {
    return view('auth.login');
});

// Dashboard/menu (usuarios autenticados)
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/menu', function () {
        return view('menu');
    })->name('menu');

    Route::get('/dashboard', function() {
        return redirect()->route('menu');
    })->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Centers
    Route::resource('centers', CenterController::class);
    Route::patch('/centers/{center}/active', [CenterController::class, 'active'])->name('centers.active');
    Route::delete('/centers/{center}', [CenterController::class, 'destroy'])->name('centers.destroy');

    // Profesionales
    Route::resource('profesional', ProfesionalController::class);
    Route::patch('/profesional/{profesional}/active', [ProfesionalController::class, 'active'])->name('profesional.active');
    Route::get('/profesional/{profesional}', [ProfesionalController::class, 'show'])->name('profesional.show');
    Route::delete('/profesional/{profesional}', [ProfesionalController::class, 'destroy'])->name('profesional.destroy');

Route::resource('projectes_comissions', Projectes_comissionsController::class);

// Listados separados
Route::get('/projectes', [Projectes_comissionsController::class, 'projectes'])
     ->name('projectes_comissions.projectes');

Route::get('/comissions', [Projectes_comissionsController::class, 'comissions'])
     ->name('projectes_comissions.comissions');

// Crear
Route::get('projectes_comissions/create', [Projectes_comissionsController::class, 'create'])
     ->name('projectes_comissions.create');

Route::post('projectes_comissions', [Projectes_comissionsController::class, 'store'])
     ->name('projectes_comissions.store');

// Editar / Actualizar
Route::get('projectes_comissions/{projectes_comission}/edit', [Projectes_comissionsController::class, 'edit'])
     ->name('projectes_comissions.edit');

Route::patch('projectes_comissions/{projectes_comission}', [Projectes_comissionsController::class, 'update'])
     ->name('projectes_comissions.update');

// Activar / Desactivar
Route::patch('projectes_comissions/{projectes_comission}/active', [Projectes_comissionsController::class, 'active'])
     ->name('projectes_comissions.active');

// Eliminar
Route::delete('projectes_comissions/{projectes_comission}', [Projectes_comissionsController::class, 'destroy'])
     ->name('projectes_comissions.destroy');

// Mostrar detalles
Route::get('projectes_comissions/{projectes_comission}', [Projectes_comissionsController::class, 'show'])
     ->name('projectes_comissions.show');


    // Seguimiento (tracking)
    Route::resource('tracking', TrackingController::class)->except(['destroy']);
    Route::patch('/tracking/{tracking}/active', [TrackingController::class, 'active'])->name('tracking.active');
    Route::delete('/tracking/{tracking}', [TrackingController::class, 'destroy'])->name('tracking.destroy');
    Route::get('/tracking/create', [TrackingController::class, 'create'])->name('tracking.create');

    // Evaluaciones
    Route::resource('evaluation', EvaluationController::class)->except(['destroy']);
    Route::patch('evaluation/{evaluation}/active', [EvaluationController::class, 'active'])->name('evaluation.active');
    Route::get('/evaluation/{evaluation}/download', [EvaluationController::class, 'download'])->name('evaluation.download');
    Route::get('/evaluation/create', [EvaluationController::class, 'create'])->name('evaluation.create');
    Route::delete('evaluation/{evaluation}', [EvaluationController::class, 'destroy'])->name('evaluation.destroy');

    // Trainings
    Route::resource('trainings', TrainingController::class);
    Route::patch('/trainings/{training}/active', [TrainingController::class, 'active'])->name('trainings.active');
    Route::delete('/trainings/{training}', [TrainingController::class, 'destroy'])->name('trainings.destroy');
     // Trainings – afegir professionals
     Route::get('/trainings/{training}/afegir-professionals',
     [TrainingController::class, 'addProfessionals']
     )->name('trainings.afegir_professionals');

     Route::post('/trainings/{training}/afegir-professionals',
     [TrainingController::class, 'updateProfessionals']
     )->name('trainings.update_professionals');

          // Trainings – update professionals
     Route::post('/trainings/{training}/update-professionals',
     [TrainingController::class, 'updateProfessionals']
     )->name('trainings.updateProfessionals');

     Route::get('/trainings/{training}/afegir-professionals',
     [TrainingController::class, 'addProfessionals']
     )->name('trainings.afegir_professionals');



    // Exportaciones
    Route::get('/export/taquilla', [ExportController::class, 'exportTaquilla'])->name('export.taquilla');
    Route::get('/export/uniform', [ExportController::class, 'exportUniform'])->name('export.uniform');
    Route::get('/export/cursos', [ExportController::class, 'exportCursos'])->name('export.cursos');

});

require __DIR__.'/auth.php';
