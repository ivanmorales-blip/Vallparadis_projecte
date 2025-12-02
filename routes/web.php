<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\Projectes_comissionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\HumanResourcesController;
use App\Http\Controllers\TemesPendentsController;
use App\Models\TemaPendent;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\DocumentacioController;
use App\Http\Controllers\MaintenanceController;
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

    // Drag & Drop profesionales (PARÁMETRO CORRECTO)
    Route::get('/projectes_comissions/{projectes_comission}/afegir-professionals', 
        [Projectes_comissionsController::class, 'addProfessionals'])
        ->name('projectes_comissions.addProfessionals');

    Route::post('/projectes_comissions/{projectes_comission}/update-professionals', 
        [Projectes_comissionsController::class, 'updateProfessionals'])
        ->name('projectes_comissions.updateProfessionals');

    // Activar / Desactivar proyecto o comissió
    Route::patch('/projectes_comissions/{projectes_comission}/active', 
        [Projectes_comissionsController::class, 'active'])
        ->name('projectes_comissions.active');

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

    // Documentacio
    Route::resource('documentacio', DocumentacioController::class);
    Route::patch('/documentacio/{documentacio}/active', [DocumentacioController::class, 'active'])->name('documentacio.active');
    Route::delete('/documentacio/{documentacio}', [DocumentacioController::class, 'destroy'])->name('documentacio.destroy');

     // Manteniment
     Route::resource('manteniment', MaintenanceController::class);
     Route::patch('/manteniment/{manteniment}/active', [MaintenanceController::class, 'active'])->name('manteniment.active');
     Route::delete('/manteniment/{manteniment}', [MaintenanceController::class, 'destroy'])->name('manteniment.destroy');

     // Exportar datos
     Route::get('/export/taquilla', [ExportController::class, 'exportTaquilla'])->name('export.taquilla');
     Route::get('/export/uniform', [ExportController::class, 'exportUniform'])->name('export.uniform');
     Route::get('/export/cursos', [ExportController::class, 'exportCursos'])->name('export.cursos');

     Route::resource('evaluation', EvaluationController::class);
     Route::get('/evaluation/{evaluation}/download', [EvaluationController::class, 'download'])->name('evaluation.download');
     Route::get('/evaluation/{evaluation}/download', [App\Http\Controllers\EvaluationController::class, 'download'])
     ->name('evaluation.download');

     


    Route::get('/dashboard', function() {
    return redirect()->route('menu'); // O cualquier página que quieras

})->name('dashboard');


});


    Route::get('/dashboard', function() {
    return redirect()->route('menu'); // O cualquier página que quieras

})->name('dashboard');;

require __DIR__.'/auth.php';
