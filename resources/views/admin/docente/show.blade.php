<x-admin>
    @section('title', 'Detalle del Docente')
    
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h4 class="mb-0"><i class="fas fa-user-tie me-2"></i>{{ $docente->nombre }} {{ $docente->apellido }}</h4>
            <div>
                <a href="{{ route('admin.docente.edit', $docente->id) }}" class="btn btn-light btn-sm me-2">
                    <i class="fas fa-edit me-1"></i>Editar
                </a>
                <a href="{{ route('admin.docente.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i>Volver
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row">
                <!-- Información personal -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>Información Personal</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user text-primary fa-fw me-2"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted">Nombre Completo</span>
                                    <p class="mb-0 fw-bold">{{ $docente->nombre }} {{ $docente->apellido }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-id-badge text-primary fa-fw me-2"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted">Cédula</span>
                                    <p class="mb-0 fw-bold">{{ $docente->cedula }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-graduation-cap text-primary fa-fw me-2"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted">Título</span>
                                    <p class="mb-0 fw-bold">{{ $docente->titulo }}</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                 <div class="flex-shrink-0">
                                    <i class="fas fa-user-graduate text-primary fa-fw me-2"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted">Maestría</span>
                                    <p class="mb-0 fw-bold">
                                        {{ $docente->maestria ?: 'Sin asignar' }}
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-graduate text-primary fa-fw me-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        <span class="text-muted">Doctorado</span>
                        <p class="mb-0 fw-bold">
                            {{ $docente->doctorado ?: 'Sin asignar' }}
                        </p>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-graduate text-primary fa-fw me-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        <span class="text-muted">Postgrado</span>
                        <p class="mb-0 fw-bold">
                            {{ $docente->postgrado ?: 'Sin asignar' }}
                        </p>
                    </div>
                </div>
                 <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-file-alt text-primary fa-fw me-2"></i>
                    </div>
                    <div class="flex-grow-1">
                        <span class="text-muted">Otro</span>
                        <p class="mb-0 fw-bold">
                            {{ $docente->otro ?: 'Sin asignar' }}
                        </p>
                    </div>
                </div>
                 <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <i class="fas fa-layer-group text-primary fa-fw me-2"></i>
                </div>
                <div class="flex-grow-1">
                    <span class="text-muted">Categoría</span>
                    <p class="mb-0 fw-bold">
                        {{ $docente->categoria ?: 'Sin asignar' }}
                    </p>
                </div>
            </div>
                        <div class="d-flex mb-3">
            <div class="flex-shrink-0">
                <i class="fas fa-file-contract text-primary fa-fw me-2"></i>
            </div>
            <div class="flex-grow-1">
                <span class="text-muted">Tipo de Contratación</span>
                <p class="mb-0 fw-bold">
                    {{ $docente->tipo_contratacion ?: 'Sin asignar' }}
                </p>
            </div>
            </div>

                            
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-envelope text-primary fa-fw me-2"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted">Correo</span>
                                    <p class="mb-0 fw-bold">{{ $docente->correo }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-phone text-primary fa-fw me-2"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-muted">Teléfono</span>
                                    <p class="mb-0 fw-bold">{{ $docente->telefono }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Unidades Curriculares y Horarios -->
                <div class="col-md-8 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-book me-2"></i>Unidades Curriculares</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Unidad Curricular</th>
                                            <th>Semestre</th>
                                            <th>Periodo</th>
                                            <th>Sección</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($asignaciones as $asignacion)
                                        <tr>
                                            <td>{{ $asignacion->unidadCurricular->nombre }}</td>
                                            <td>{{ $asignacion->unidadCurricular->semestre }}</td>
                                            <td>{{ $asignacion->periodoAcademico->periodo }}</td>
                                            <td>{{ $asignacion->seccion->nombre }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">
                                                <i class="fas fa-info-circle me-2"></i>No tiene unidades curriculares asignadas.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Horarios -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Horarios Asignados</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Unidad Curricular</th>
                                    <th>Día</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($horarios as $h)
                                <tr>
                                    <td>{{ $h->unidadCurricular->nombre }}</td>
                                    <td><span class="badge bg-primary">{{ $h->dia }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($h->hora_inicio)->format('H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($h->hora_finalizacion)->format('H:i') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        <i class="fas fa-info-circle me-2"></i>No tiene horarios asignados.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <!-- Propuestas TG -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Propuestas de Trabajo de Grado</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @forelse($propuestasTG as $tg)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">
                                                <a href="{{ route('admin.propuesta_tg.show', $tg->id) }}">
                                                    {{ $tg->titulo_propuesta }}
                                                </a>
                                            </div>
                                            <span class="text-muted">{{ $tg->nombre_tesista }} {{ $tg->apellido_tesista }}</span>
                                        </div>
                                        <span class="badge bg-success rounded-pill">{{ $tg->estatus }}</span>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center text-muted">
                                        <i class="fas fa-info-circle me-2"></i>No tiene propuestas TG asignadas.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Propuestas TP -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Propuestas de Pasantía</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @forelse($propuestasTP as $tp)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">
                                                <a href="{{ route('admin.propuesta_tp.show', $tp->id) }}">
                                                    {{ $tp->titulo_propuesta }}
                                                </a>
                                            </div>
                                            <span class="text-muted">{{ $tp->nombre_pasante }} {{ $tp->apellido_pasante }}</span>
                                        </div>
                                        <span class="badge bg-success rounded-pill">{{ $tp->estatus }}</span>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center text-muted">
                                        <i class="fas fa-info-circle me-2"></i>No tiene propuestas TP asignadas.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-hands-helping me-2"></i>Servicios Comunitarios
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @forelse ($servicios as $sc)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">
                                            <a href="{{ route('admin.servicio_comunitario.show', $sc->id) }}">
                                                {{ $sc->titulo_servicio }}
                                            </a>
                                        </div>
                                        <span class="text-muted">
                                            {{ $sc->nombre_estudiante }} {{ $sc->apellido_estudiante }}
                                        </span>
                                    </div>
                                    <span class="badge bg-success rounded-pill">{{ $sc->estatus }}</span>
                                </li>
                            @empty
                                <li class="list-group-item text-center text-muted">
                                    <i class="fas fa-info-circle me-2"></i>No tiene servicios comunitarios asignados.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Evaluaciones de Desempeño</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Unidad Curricular</th>
                                    <th>Periodo</th>
                                    <th>Puntualidad</th>
                                    <th>Evaluado por</th>
                                    <th>Ver detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($desempenos as $d)
                                <tr>
                                    <td>{{ $d->unidadCurricularPeriodoAcademico->unidadCurricular->nombre }}</td>
                                    <td>{{ $d->unidadCurricularPeriodoAcademico->periodoAcademico->periodo }}</td>
                                    <td>
                                        @if($d->puntualidad >= 80)
                                            <span class="badge bg-success">{{ $d->puntualidad }}%</span>
                                        @elseif($d->puntualidad >= 60)
                                            <span class="badge bg-warning">{{ $d->puntualidad }}%</span>
                                        @else
                                            <span class="badge bg-danger">{{ $d->puntualidad }}%</span>
                                        @endif
                                    </td>
                                    <td>{{ $d->evaluador?->apellido }}, {{ $d->evaluador?->nombre }}</td>
                                      <td class="fw-bold">
                                        <a  href="{{ route('admin.desempeno-docente.show', $d->id) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Ver detalle">
                                            Detalle
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        <i class="fas fa-info-circle me-2"></i>No 
                                        tiene evaluaciones registradas.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-clipboard-list me-2"></i>Lineamientos del Docente
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse ($lineamientos as $lin)
                            <div class="list-group-item border-start-0 border-end-0">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="w-75">
                                        <h6 class="fw-bold text-primary mb-1">{{ $lin->titulo ?? 'Lineamiento' }}</h6>
                                        <p class="mb-1 text-muted small">
                                            {{ Str::limit($lin->resumen, 120) }}
                                        </p>
                                        <div class="d-flex align-items-center mt-2">
                                            <span class="badge bg-light text-dark me-2">
                                                <i class="far fa-calendar-alt me-1"></i>
                                                {{ $lin->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                        <span class="badge bg-primary rounded-pill mb-2">
                                            {{ $lin->categoria ?? 'General' }}
                                        </span>
                                        <a  href="{{ route('admin.lineamiento-docente.show', $lin->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                             Ver detalle
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="list-group-item py-4 text-center">
                                <div class="text-muted mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                </div>
                                <p class="mb-0">No hay lineamientos registrados actualmente.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Temario -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Temario</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @forelse($temarios as $t)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">
                                                <a href="{{ route('admin.teamrio_docente.show', $t->id) }}">
                                                    {{ $t->titulo_propuesta }}
                                                </a>
                                            </div>
                                            <span class="text-muted">{{ $tg->nombre_tesista }} {{ $tg->apellido_tesista }}</span>
                                        </div>
                                        <span class="badge bg-success rounded-pill">{{ $tg->estatus }}</span>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center text-muted">
                                        <i class="fas fa-info-circle me-2"></i>No tiene temario agregado.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Plan evaluación-->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Plan evaluación</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @forelse($propuestasTP as $tp)
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">
                                                <a href="{{ route('admin.propuesta_tp.show', $tp->id) }}">
                                                    {{ $tp->titulo_propuesta }}
                                                </a>
                                            </div>
                                            <span class="text-muted">{{ $tp->nombre_pasante }} {{ $tp->apellido_pasante }}</span>
                                        </div>
                                        <span class="badge bg-success rounded-pill">{{ $tp->estatus }}</span>
                                    </li>
                                @empty
                                    <li class="list-group-item text-center text-muted">
                                        <i class="fas fa-info-circle me-2"></i>No tiene plan de evalueción agregado.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</x-admin>