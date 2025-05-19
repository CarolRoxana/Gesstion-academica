<x-admin>
    @section('title', 'Detalle de Propuesta TG')

    @section('content_header')
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Detalle de Propuesta de Trabajo de Grado</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.propuesta_tg.index') }}">Propuestas TG</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                </ol>
            </nav>
        </div>
    @endsection

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-file-alt me-2"></i>{{ $propuesta->titulo_propuesta }}</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-light rounded-circle p-2 me-3">
                                <i class="fas fa-user-graduate text-primary"></i>
                            </div>
                            <h5 class="mb-0">Información {{ isset($propuesta->nombre_tesista2) || isset($propuesta->nombre_tesista3) ? 'de los Tesistas' : 'del Tesista' }}</h5>
                        </div>
                        <div class="ps-5 border-start border-2 border-light ms-2 mt-3">
                        @if(isset($propuesta->nombre_tesista2) || isset($propuesta->nombre_tesista3))
                            <h6 class="fw-bold mb-2">Tesista 1</h6>
                        @endif
                        <div class="row mb-2">
                            <div class="col-md-3 text-muted">Nombre completo:</div>
                            <div class="col-md-9 fw-bold">{{ $propuesta->nombre_tesista }} {{ $propuesta->apellido_tesista }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 text-muted">Cédula:</div>
                            <div class="col-md-9">{{ $propuesta->cedula }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 text-muted">Carrera:</div>
                            <div class="col-md-9">{{ $propuesta->carrera }}</div>
                        </div>
                    </div>
                    
                    <!-- Tesista 2 (mostrar solo si existe) -->
                    @if(isset($propuesta->nombre_tesista2) && !empty($propuesta->nombre_tesista2))
                        <div class="ps-5 border-start border-2 border-light ms-2 mt-4">
                            <h6 class="fw-bold mb-2">Tesista 2</h6>
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Nombre completo:</div>
                                <div class="col-md-9 fw-bold">{{ $propuesta->nombre_tesista2 }} {{ $propuesta->apellido_tesista2 }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Cédula:</div>
                                <div class="col-md-9">{{ $propuesta->cedula2 }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Carrera:</div>
                                <div class="col-md-9">{{ $propuesta->carrera2 }}</div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Tesista 3 (mostrar solo si existe) -->
                    @if(isset($propuesta->nombre_tesista3) && !empty($propuesta->nombre_tesista3))
                        <div class="ps-5 border-start border-2 border-light ms-2 mt-4">
                            <h6 class="fw-bold mb-2">Tesista 3</h6>
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Nombre completo:</div>
                                <div class="col-md-9 fw-bold">{{ $propuesta->nombre_tesista3 }} {{ $propuesta->apellido_tesista3 }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Cédula:</div>
                                <div class="col-md-9">{{ $propuesta->cedula3 }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Carrera:</div>
                                <div class="col-md-9">{{ $propuesta->carrera3 }}</div>
                            </div>
                        </div>
                    @endif
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-light rounded-circle p-2 me-3">
                                <i class="fas fa-chalkboard-teacher text-primary"></i>
                            </div>
                            <h5 class="mb-0">Información del Tutor</h5>
                        </div>
                        <div class="ps-5 border-start border-2 border-light ms-2 mt-3">
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Docente tutor:</div>
                                <div class="col-md-9">{{ $propuesta->docente->nombre }} {{ $propuesta->docente->apellido }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-light rounded-circle p-2 me-3">
                                <i class="fas fa-info-circle text-primary"></i>
                            </div>
                            <h5 class="mb-0">Detalles de la Propuesta</h5>
                        </div>
                        <div class="ps-5 border-start border-2 border-light ms-2 mt-3">
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Fecha ingreso:</div>
                                <div class="col-md-9">
                                    <i class="far fa-calendar-alt me-1 text-secondary"></i>
                                    {{\Carbon\Carbon::parse($propuesta->fecha_ingreso)->format('d-m-Y') }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Estatus:</div>
                                <div class="col-md-9">
                                    @if($propuesta->estatus === 'Aprobado')
                                        <span class="badge bg-success p-2">
                                            <i class="fas fa-check-circle me-1"></i>{{ $propuesta->estatus }}
                                        </span>
                                    @elseif($propuesta->estatus === 'Rechazado')
                                        <span class="badge bg-danger p-2">
                                            <i class="fas fa-times-circle me-1"></i>{{ $propuesta->estatus }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning p-2">
                                            <i class="fas fa-clock me-1"></i>{{ $propuesta->estatus }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 text-muted">Archivo:</div>
                                <div class="col-md-9">
                                    @if ($propuesta->archivo)
                                        <a href="{{ asset('storage/' . $propuesta->archivo) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-file-pdf me-1"></i> Ver documento PDF
                                        </a>
                                    @else
                                        <span class="text-muted">
                                            <i class="fas fa-exclamation-circle me-1"></i> No disponible
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.propuesta_tg.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver al listado
                    </a>
                    <div>
                        <a href="{{ route('admin.propuesta_tg.edit', $propuesta->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Editar propuesta
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Resumen</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-calendar-day text-primary me-2"></i>Fecha ingreso</span>
                            <span class="badge bg-light text-dark">{{\Carbon\Carbon::parse($propuesta->fecha_ingreso)->format('d-m-Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-user-check text-primary me-2"></i>Estado</span>
                            <span class="badge bg-{{ $propuesta->estatus === 'Aprobado' ? 'success' : ($propuesta->estatus === 'Rechazado' ? 'danger' : 'warning') }}">
                                {{ $propuesta->estatus }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-graduation-cap text-primary me-2"></i>Carrera</span>
                            <span class="badge bg-light text-dark">{{ $propuesta->carrera }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>

</x-admin>