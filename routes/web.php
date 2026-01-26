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
    HumanResourcesController,
    Additional_servicesController,
    External_ContactsController,
    serveis_adicionalsController,
    AccidentabilitatController,
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
    Route::middleware(['auth', \App\Http\verificador\verificador::class . ':equipdirectiu'])->group(function () {
    Route::resource('tracking', TrackingController::class);
    Route::patch('tracking/{tracking}/active', [TrackingController::class, 'active'])->name('tracking.active');
    });

    /*
    | SERVICIOS GENERALES 
    */
    Route::middleware(['auth', \App\Http\verificador\verificador::class . ':equipdirectiu,equipadministracio'])->group(function () {
    Route::resource('general_services', General_servicesController::class);
    });

    /*servicis adicionals*/
    Route::middleware(['auth', \App\Http\verificador\verificador::class . ':equipdirectiu,equipadministracio'])->group(function () {
    Route::resource('serveis_adicional', Additional_servicesController::class);
    });
    /*
    |--------------------------------------------------------------------------
    | TRACKING - PROFESIONAL
    |--------------------------------------------------------------------------
    */
    Route::get('tracking/profesional/create/{profesional?}', [TrackingController::class, 'createForProfesional'])->name('tracking.profesional.create');
    Route::post('tracking/profesional', [TrackingController::class, 'storeForProfesional'])->name('tracking.profesional.store');
    Route::get('tracking/profesional/{tracking}', [TrackingController::class, 'showForProfesional'])->name('tracking.profesional.show');
    Route::get('tracking/profesional/{tracking}/edit', [TrackingController::class, 'editForProfesional'])->name('tracking.profesional.edit');
    Route::patch('tracking/profesional/{tracking}', [TrackingController::class, 'updateForProfesional'])->name('tracking.profesional.update');
    Route::patch('tracking/profesional/{tracking}/active', [TrackingController::class, 'activeForProfesional'])->name('tracking.profesional.active');
    Route::delete('tracking/profesional/{tracking}', [TrackingController::class, 'destroyForProfesional'])->name('tracking.profesional.destroy');

   /*
    |--------------------------------------------------------------------------
    | SEGUIMENTS PER A SERVEIS GENERALS
    |--------------------------------------------------------------------------
    */

    // Formulari alta seguiment d’un servei general
    Route::get(
        'general-services/{generalService}/trackings/create',
        [TrackingController::class, 'createForGeneralService']
    )->name('tracking.general_service.create');

    // Guardar seguiment
    Route::post(
        'general-services/trackings',
        [TrackingController::class, 'storeForGeneralService']
    )->name('tracking.general_service.store');

    // Veure un seguiment
    Route::get(
        'general-services/trackings/{tracking}',
        [TrackingController::class, 'showForGeneralService']
    )->name('tracking.general_service.show');

    // Editar seguiment
    Route::get(
        'general-services/trackings/{tracking}/edit',
        [TrackingController::class, 'editForGeneralService']
    )->name('tracking.general_service.edit');

    // Actualitzar seguiment
    Route::patch(
        'general-services/trackings/{tracking}',
        [TrackingController::class, 'updateForGeneralService']
    )->name('tracking.general_service.update');

    // Eliminar seguiment
    Route::delete(
        'general-services/trackings/{tracking}',
        [TrackingController::class, 'destroyForGeneralService']
    )->name('tracking.general_service.destroy');
    // Seguiments Manteniment
    Route::get('tracking/maintenance/{maintenance}/create', [TrackingController::class, 'createForMaintenance'])->name('tracking.maintenance.create');
    Route::post('tracking/maintenance', [TrackingController::class, 'storeForMaintenance'])->name('tracking.maintenance.store');
    Route::get('tracking/maintenance/{tracking}/edit', [TrackingController::class, 'editForMaintenance'])->name('tracking.maintenance.edit');
    Route::put('tracking/maintenance/{tracking}', [TrackingController::class, 'updateForMaintenance'])->name('tracking.maintenance.update');
    Route::delete('tracking/maintenance/{tracking}', [TrackingController::class, 'destroyForMaintenance'])->name('tracking.maintenance.destroy');
    Route::get('tracking/maintenance/{tracking}', [TrackingController::class, 'showForMaintenance'])->name('tracking.maintenance.show');

    // CREAR SEGUIMENT (para un TemaPendent específico)
    Route::get('tracking/human_resource/{humanResource}/create', [TrackingController::class, 'createForHumanResource'])
        ->name('tracking.human_resource.create');


    // GUARDAR SEGUIMENT
    Route::post('tracking/human_resource', [TrackingController::class, 'storeForHumanResource'])
        ->name('tracking.human_resource.store');

    // EDITAR SEGUIMENT
    Route::get('tracking/human_resource/{tracking}/edit', [TrackingController::class, 'editForHumanResource'])
        ->name('tracking.human_resource.edit');

    // ACTUALIZAR SEGUIMENT
    Route::put('tracking/human_resource/{tracking}', [TrackingController::class, 'updateForHumanResource'])
        ->name('tracking.human_resource.update');

    // ELIMINAR SEGUIMENT
    Route::delete('tracking/human_resource/{tracking}', [TrackingController::class, 'destroyForHumanResource'])
        ->name('tracking.human_resource.destroy');

    // MOSTRAR SEGUIMENT
    Route::get('tracking/human_resource/{tracking}', [TrackingController::class, 'showForHumanResource'])
        ->name('tracking.human_resource.show');

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
    Route::middleware(['auth', \App\Http\verificador\verificador::class . ':equipdirectiu'])->group(function () {
    Route::resource('documentacio', DocumentacioController::class);
    Route::patch('documentacio/{documentacio}/active', [DocumentacioController::class, 'active'])->name('documentacio.active');
        });

    /*
    | Mantenimiento
    */

    Route::middleware(['auth', \App\Http\verificador\verificador::class . ':equipdirectiu,equipadministracio'])->group(function () {
    Route::resource('manteniment', MaintenanceController::class);
    Route::patch('manteniment/{manteniment}/active', [MaintenanceController::class, 'active'])->name('manteniment.active');
        });

    
        /*
    | Recursos Humans
    */
// Listado de temes pendents por centro
    Route::get('human_resources/{centre_id}', [HumanResourcesController::class, 'index'])
        ->name('human_resources.index');

    // Mostrar un tema pendent
    Route::get('human_resources/show/{id}', [HumanResourcesController::class, 'show'])
        ->name('human_resources.show');

    // Formulario de creación
    Route::get('human_resources/create/{centre_id}', [HumanResourcesController::class, 'create'])
        ->name('human_resources.create');

    // Guardar nuevo tema pendent
    Route::post('human_resources/store/{centre_id}', [HumanResourcesController::class, 'store'])
        ->name('human_resources.store');

    // Formulario de edición
    Route::get('human_resources/{tema}/edit', [HumanResourcesController::class, 'edit'])
        ->name('human_resources.edit');

    // Actualizar tema pendent
    Route::put('human_resources/{tema}', [HumanResourcesController::class, 'update'])
        ->name('human_resources.update');

    // Activar / desactivar tema pendent
    Route::patch('human_resources/{tema}/active', [HumanResourcesController::class, 'toggleActive'])
        ->name('human_resources.active');

    
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
    | Contactos Externos
    */

// Listar contactos
Route::get('external-contacts', [External_ContactsController::class, 'index'])
    ->name('external_contacts.index');

// Crear contacto (centro opcional)
Route::get('external-contacts/create/{centre_id?}', [External_ContactsController::class, 'create'])
    ->name('external_contacts.create');

// Guardar contacto
Route::post('external-contacts/store', [External_ContactsController::class, 'store'])
    ->name('external_contacts.store');

Route::get('external-contacts/{id}', [External_ContactsController::class, 'show'])
    ->name('external_contacts.show');

Route::get('external-contacts/{id}/edit', [External_ContactsController::class, 'edit'])
    ->name('external_contacts.edit');

Route::patch('external-contacts/{id}/active', [External_ContactsController::class, 'active'])
    ->name('external_contacts.active');

Route::put('external-contacts/{id}', [External_ContactsController::class, 'update'])
    ->name('external_contacts.update');

   

    // Show form
    Route::get('documentacioprofesional/create/{profesional}', [DocumentacioprofesionalController::class, 'create'])
        ->name('documentacioprofesional.create');

    // Store document
    Route::post('documentacioprofesional', [DocumentacioprofesionalController::class, 'store'])
        ->name('documentacioprofesional.store');

    // Show single document
    Route::get('documentacioprofesional/{documentacio}', [DocumentacioprofesionalController::class, 'show'])
        ->name('documentacioprofesional.show');

    // Edit document
    Route::get('documentacioprofesional/{documentacio}/edit', [DocumentacioprofesionalController::class, 'edit'])
        ->name('documentacioprofesional.edit');

    // Update document
    Route::put('documentacioprofesional/{documentacio}', [DocumentacioprofesionalController::class, 'update'])
        ->name('documentacioprofesional.update');

    // Activate/deactivate
    Route::patch('documentacioprofesional/{documentacio}/active', [DocumentacioprofesionalController::class, 'active'])
        ->name('documentacioprofesional.active');

    /* Accidentabilitat */
    Route::middleware(['auth', \App\Http\verificador\verificador::class . ':equipdirectiu,equipadministracio'])->group(function () {
        Route::resource('accidentabilitat', AccidentabilitatController::class);
        Route::patch('accidentabilitat/{accidentabilitat}/active', [AccidentabilitatController::class, 'active'])->name('accidentabilitat.active');
    });
    
    // web.php
    Route::get('projectes_comissions/{projectes_comission}', [Projectes_comissionsController::class, 'show'])
        ->name('projectes_comissions.show');

    Route::get('training/{training}', [TrainingController::class, 'show'])
        ->name('training.show');

    /*
    | Exportaciones
    */
    Route::get('export/taquilla', [ExportController::class, 'exportTaquilla'])->name('export.taquilla');
    Route::get('export/uniform', [ExportController::class, 'exportUniform'])->name('export.uniform');
    Route::get('export/cursos', [ExportController::class, 'exportCursos'])->name('export.cursos');
});

require __DIR__.'/auth.php';
