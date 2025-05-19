
<x-admin>
    @section('title', 'Detalle de Evaluación')

    <div class="container py-4">
        <div class="card border-0 shadow-sm rounded-3 mb-4 overflow-hidden">
            <div class="card-header bg-gradient-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="mb-0">Detalle de Evaluación</h4>
                            <p class="text-white-50 small mb-0">
                                Periodo: {{ $evaluacion->unidadCurricularPeriodoAcademico->periodoAcademico->periodo }}
                            </p>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('admin.desempeno-docente.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>  Volver
                        </a>
                        <a href="{{ route('admin.desempeno-docente.edit', $evaluacion->id) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-pen me-1"></i>  Editar
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="p-4 bg-light">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle bg-primary text-white me-3">
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Docente</h6>
                                    <h5 class="mb-0">{{ $evaluacion->docente->nombre }} {{ $evaluacion->docente->apellido }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle bg-success text-white me-3">
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Unidad Curricular</h6>
                                    <h5 class="mb-0">{{ $evaluacion->unidadCurricularPeriodoAcademico->unidadCurricular->nombre }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4">
                    <h5 class="mb-4">Indicadores de Desempeño</h5>
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="text-muted mb-0">Puntualidad</h6>
                                        <i class="fas fa-clock text-primary"></i>
                                    </div>
                                    
                                    <div class="d-flex align-items-baseline">
                                        <h3 class="mb-0">{{ $evaluacion->puntualidad }}%</h3>
                                    </div>
                                    
                                    <div class="progress mt-3" style="height: 10px;">
                                        @if($evaluacion->puntualidad >= 80)
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                style="width: {{ $evaluacion->puntualidad }}%;"
                                                aria-valuenow="{{ $evaluacion->puntualidad }}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        @elseif($evaluacion->puntualidad >= 60)
                                            <div class="progress-bar bg-warning" role="progressbar" 
                                                style="width: {{ $evaluacion->puntualidad }}%;"
                                                aria-valuenow="{{ $evaluacion->puntualidad }}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        @else
                                            <div class="progress-bar bg-danger" role="progressbar" 
                                                style="width: {{ $evaluacion->puntualidad }}%;"
                                                aria-valuenow="{{ $evaluacion->puntualidad }}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="text-muted mb-0">Calidad de Enseñanza</h6>
                                        <i class="fas fa-chalkboard-teacher text-success"></i>
                                    </div>
                                    
                                    <div class="d-flex align-items-baseline">
                                        <h3 class="mb-0">{{ $evaluacion->calidad_ensenanza }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="text-muted mb-0">Participación en Proyectos</h6>
                                        <i class="fas fa-project-diagram text-info"></i>
                                    </div>
                                    
                                    <div class="d-flex align-items-baseline">
                                        <h3 class="mb-0">{{ $evaluacion->participacion_proyectos }}</h3>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="text-muted mb-0">Cumpl. Administrativo</h6>
                                        <i class="fas fa-tasks text-warning"></i>
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <h3 class="mb-0">{{ $evaluacion->cumplimiento_administrativo }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 border-top">
                    <div class="card border-0 bg-light rounded-3">
                        <div class="card-body p-4">
                            <h5 class="card-title">
                                <i class="fas fa-comment-alt me-2 text-primary"></i>
                                Observaciones
                            </h5>
                            <p class="card-text mb-0">{{ $evaluacion->observaciones ?: 'Sin observaciones registradas.' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 border-top bg-light">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-secondary text-white me-3">
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1 small">Evaluado Por</h6>
                                        {{ optional($evaluacion->evaluador)->apellido }},
                                        {{ optional($evaluacion->evaluador)->nombre }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-secondary text-white me-3">
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1 small">Fecha de Evaluación</h6>
                                     {{ \Carbon\Carbon::parse($evaluacion->fecha_evaluacion)->format('Y-m-d') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>