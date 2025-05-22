<?php

use App\Http\Controllers\CursoInterSemestralController;
use App\Http\Controllers\DesempenoDocenteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\DocenteUnitController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\HorarioPDFController;
use App\Http\Controllers\IncidenteEstudiantilController;
use App\Http\Controllers\LineamientoDocenteController;
use App\Http\Controllers\UnidadCurricularController;
use App\Http\Controllers\PeriodoAcademicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlanEvaluacionDocenteController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\PropuestaPDFController;
use App\Http\Controllers\PropuestaTgController;
use App\Http\Controllers\PropuestaTpController;
use App\Http\Controllers\ServicioComunitarioController;
use App\Http\Controllers\TalentoHumanoController;
use App\Http\Controllers\TemarioDocenteController;
use App\Http\Controllers\UnidadCurricularPeriodoAcademicoController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:Admin|Coordinador'])->group(function () {

        Route::resource('user', UserController::class);
        Route::put('user/{user}/role', [UserController::class, 'updateRole'])->name('user.updateRole');
        Route::resource('role', RoleController::class);
        Route::resource('permission', PermissionController::class);
        //Route::get('/profesores', [ProfesorController::class, 'index'])->name('profesores.index');
        Route::get('/profesores/export', [ProfesorController::class, 'export'])->name('admin.profesores.export');
        Route::resource('/horario', HorarioController::class);
        Route::get('/horario/aulas/{sede}', [HorarioController::class, 'aulasPorSede'])->name('horario.aulas');
        Route::get('/horario/unidadesCurriculares/{periodo}', [HorarioController::class, 'unidadesCurriculares'])->name('horario.unidadesCurriculares');
        //Route::resource('/docente', DocenteController::class);
        Route::resource('/periodo-academico', PeriodoAcademicoController::class);
        Route::resource('/unidad-curricular', UnidadCurricularController::class);
        Route::resource('/unidad-curricular-periodo', UnidadCurricularPeriodoAcademicoController::class);
        Route::resource('/lineamiento-docente', LineamientoDocenteController::class);
        Route::resource('/desempeno-docente', DesempenoDocenteController::class);
        Route::resource('/curso-inter-semestral', CursoInterSemestralController::class);
        Route::resource('/plan_evaluacion_docente', PlanEvaluacionDocenteController::class);
        //Route::resource('/temario_docente', TemarioDocenteController::class);
        Route::resource('/propuesta_tg', PropuestaTgController::class);
        //Route::resource('/propuesta_tp', PropuestaTpController::class);
        Route::resource('/talento_humano', TalentoHumanoController::class);
        Route::resource('/incidente-estudiantil', IncidenteEstudiantilController::class);
        Route::get('/horarios/pdf/{periodo}', [HorarioPDFController::class, 'exportHorarioPDF'])->name('admin.horarios.pdf');
        Route::get('/propuestas/grado/pdf', [PropuestaPDFController::class, 'exportGradoPDF'])->name('admin.propuestas.grado.pdf');
        //Route::get('/propuestas/pasantia/pdf', [PropuestaPDFController::class, 'exportPasantiaPDF'])->name('propuestas.pasantia.pdf');
        Route::get('/unidad-curricular/{id}/secciones', [UnidadCurricularController::class, 'getSecciones']);
        //Route::resource('/servicio_comunitario', ServicioComunitarioController::class)->parameters(['servicio_comunitario' => 'servicio']);
    });


    Route::middleware(['role:Jefe departamento'])->group(function () {
       // Route::resource('/talento_humano', TalentoHumanoController::class);
       // Route::resource('/curso-inter-semestral', CursoInterSemestralController::class);
    });
    Route::middleware(['role:Jefe area'])->group(function () {
        //Route::resource('/talento_humano', TalentoHumanoController::class);
        //Route::resource('/desempeno-docente', DesempenoDocenteController::class); 
        //Route::get('/profesores', [ProfesorController::class, 'index'])->name('profesores.index');
        //Route::get('/profesores/export', [ProfesorController::class, 'export'])->name('profesores.export');
    });

    //Secretaria
    Route::middleware(['role:Secretaria'])->group(function () {
        //Route::get('/horarios/pdf/{periodo}', [HorarioPDFController::class, 'exportHorarioPDF'])->name('horarios.pdf');
        //Route::get('/horario', [HorarioController::class, 'index'])->name('horario.index');
        //Route::resource('/docente', DocenteController::class)->except(['destroy', 'delete']);
        //Route::get('/profesores', [ProfesorController::class, 'index'])->name('profesores.index');
        //Route::get('/profesores/export', [ProfesorController::class, 'export'])->name('profesores.export');
        //Route::resource('/propuesta_tg', PropuestaTgController::class)->names('propuesta_tg');
        //Route::get('/propuestas/grado/pdf', [PropuestaPDFController::class, 'exportGradoPDF'])->name('propuestas.grado.pdf');
        //Route::resource('/propuesta_tp', PropuestaTpController::class);
        //Route::get('/propuestas/pasantia/pdf', [PropuestaPDFController::class, 'exportPasantiaPDF'])->name('propuestas.pasantia.pdf');
    });

    Route::middleware(['role:Docente'])->group(function () {
        Route::resource('/docente_unit', DocenteUnitController::class);
        //Route::resource('/temario_docente', TemarioDocenteController::class);
        //Route::resource('/plan_evaluacion_docente', PlanEvaluacionDocenteController::class);

        //Route::resource('/propuesta_tg', PropuestaTgController::class)->names('propuesta_tg');
        //Route::get('/propuestas/grado/pdf', [PropuestaPDFController::class, 'exportGradoPDF'])->name('propuestas.grado.pdf');
        //Route::resource('/propuesta_tp', PropuestaTpController::class);
        //Route::get('/propuestas/pasantia/pdf', [PropuestaPDFController::class, 'exportPasantiaPDF'])->name('propuestas.pasantia.pdf');
    });


    //VERDADERO ORDEN DE RUTAS
    Route::middleware(['role:Jefe departamento|Admin|Coordinador'])->group(function () {
            Route::resource('/talento_humano', TalentoHumanoController::class);
        Route::resource('/curso-inter-semestral', CursoInterSemestralController::class);
    });

    Route::middleware(['role:Jefe area|Admin|Coordinador'])->group(function () {
        Route::resource('/talento_humano', TalentoHumanoController::class);
        Route::resource('/desempeno-docente', DesempenoDocenteController::class);
    });


    Route::middleware(['role:Secretaria|Admin|Coordinador'])->group(function () {
        Route::resource('/docente', DocenteController::class);
        Route::get('/horario', [HorarioController::class, 'index'])->name('horario.index');
        Route::get('/horarios/pdf/{periodo}', [HorarioPDFController::class, 'exportHorarioPDF'])->name('horarios.pdf');
    });

    Route::middleware(['role:Docente|Admin|Coordinador'])->group(function () {
        Route::resource('/plan_evaluacion_docente', PlanEvaluacionDocenteController::class);
        Route::resource('/temario_docente', TemarioDocenteController::class);
       
    });

    Route::middleware(['role:Jefe area|Admin|Coordinador|Secretaria'])->group(function () {
        Route::get('/profesores/export', [ProfesorController::class, 'export'])->name('profesores.export');
        Route::get('/profesores', [ProfesorController::class, 'index'])->name('profesores.index');
    });

    Route::middleware(['role:Docente|Admin|Coordinador|Secretaria'])->group(function () {
        Route::resource('/propuesta_tp', PropuestaTpController::class);
        Route::resource('/propuesta_tg', PropuestaTgController::class)->names('propuesta_tg');
        Route::get('/propuestas/grado/pdf', [PropuestaPDFController::class, 'exportGradoPDF'])->name('propuestas.grado.pdf');
        Route::get('/propuestas/pasantia/pdf', [PropuestaPDFController::class, 'exportPasantiaPDF'])->name('propuestas.pasantia.pdf');
         Route::resource('/servicio_comunitario', ServicioComunitarioController::class)->parameters(['servicio_comunitario' => 'servicio']);
    });
});
