<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\TemaPendent;

// Controllers
use App\Http\Controllers\{
    ProfileController,
    CenterController,
    ProfesionalController,
    Projectes_comissionsController,
    TrackingController,
    General_servicesController,
    EvaluationController,
    TrainingController,
    DocumentacioController,
    MaintenanceController,
    ExportController,
    HumanResourcesController
};

/*
|--------------------------------------------------------------------------
| RUTA LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('auth.login');
});

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    /*
    | Dashboard / Menu
    */
    Route::get('/menu', fn () => view('menu'))->name('menu');
    Route::get('/dashboard', fn () => redirect()->route('menu'))->name('dashboard');

    /*
    | Perfil
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    | Centers
    */
    Route::resource('centers', CenterController::class);
    Route::patch('centers/{center}/active', [CenterController::class, 'active'])->name('centers.active');

    /*
    | Profesionales
    */
    Route::resource('profesional', ProfesionalController::class);
    Route::patch('profesional/{profesional}/active', [ProfesionalController::class, 'active'])->name('profesional.active');

    /*
    | Proyectos / Comisiones
    */
    Route::resource('projectes_comissions', Projectes_comissionsController::class);
    Route::get('projectes', [Projectes_comissionsController::class, 'projectes'])->name('projectes_comissions.projectes');
    Route::get('comissions', [Projectes_comissionsController::class, 'comissions'])->name('projectes_comissions.comissions');

    Route::get(
        'projectes_comissions/{projectes_comission}/afegir-professionals',
        [Projectes_comissionsController::class, 'addProfessionals']
    )->name('projectes_comissions.addProfessionals');

    Route::post(
        'projectes_comissions/{projectes_comission}/update-professionals',
        [Projectes_comissionsController::class, 'updateProfessionals']
    )->name('projectes_comissions.updateProfessionals');

    Route::patch(
        'projectes_comissions/{projectes_comission}/active',
        [Projectes_comissionsController::class, 'active']
    )->name('projectes_comissions.active');

    /*
    | Tracking
    */
    Route::resource('tracking', TrackingController::class);
    Route::patch('tracking/{tracking}/active', [TrackingController::class, 'active'])->name('tracking.active');

    /*
    | SERVICIOS GENERALES ✅ (TU CONTROLADOR)
    */
    Route::resource('general_services', General_servicesController::class);

    /*
    | Evaluaciones
    */
    Route::resource('evaluation', EvaluationController::class);
    Route::patch('evaluation/{evaluation}/active', [EvaluationController::class, 'active'])->name('evaluation.active');
    Route::get('evaluation/{evaluation}/download', [EvaluationController::class, 'download'])->name('evaluation.download');

    /*
    | Trainings
    */
    Route::resource('trainings', TrainingController::class);
    Route::patch('trainings/{training}/active', [TrainingController::class, 'active'])->name('trainings.active');

    Route::get(
        'trainings/{training}/afegir-professionals',
        [TrainingController::class, 'addProfessionals']
    )->name('trainings.afegir_professionals');

    Route::post(
        'trainings/{training}/update-professionals',
        [TrainingController::class, 'updateProfessionals']
    )->name('trainings.update_professionals');

    /*
    | Documentación
    */
    Route::resource('documentacio', DocumentacioController::class);
    Route::patch('documentacio/{documentacio}/active', [DocumentacioController::class, 'active'])->name('documentacio.active');

    /*
    | Mantenimiento
    */
    Route::resource('manteniment', MaintenanceController::class);
    Route::patch('manteniment/{manteniment}/active', [MaintenanceController::class, 'active'])->name('manteniment.active');

    /*
    | Recursos Humanos
    */
    Route::get('human_resources/{centre_id}', [HumanResourcesController::class, 'index'])->name('human_resources.index');
    Route::get('human_resources/create/{centre_id}/{type}', [HumanResourcesController::class, 'create'])->name('human_resources.create');
    Route::post('human_resources/store/{centre_id}', [HumanResourcesController::class, 'store'])->name('human_resources.store');
    Route::get('human_resources/{tema}/edit', [HumanResourcesController::class, 'edit'])->name('human_resources.edit');
    Route::put('human_resources/{tema}', [HumanResourcesController::class, 'update'])->name('human_resources.update');
    Route::patch('human_resources/{tema}/active', [HumanResourcesController::class, 'toggleActive'])->name('human_resources.active');

    /*
    | Descarga documentos temas
    */
    Route::get('temes/{tema}/download', function (TemaPendent $tema) {
        if ($tema->document && Storage::disk('public')->exists($tema->document)) {
            return Storage::disk('public')->download($tema->document);
        }
        abort(404);
    })->name('temes.download');

    /*
    | Exportaciones
    */
    Route::get('export/taquilla', [ExportController::class, 'exportTaquilla'])->name('export.taquilla');
    Route::get('export/uniform', [ExportController::class, 'exportUniform'])->name('export.uniform');
    Route::get('export/cursos', [ExportController::class, 'exportCursos'])->name('export.cursos');
});

require __DIR__.'/auth.php';
