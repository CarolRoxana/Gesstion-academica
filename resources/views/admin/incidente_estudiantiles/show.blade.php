<x-admin>
    @section('title', 'Información del Incidente')

    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-body p-4">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="alert alert-info mb-4">
                        <div class="d-flex">
                            <i class="fas fa-info-circle me-2 mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-1">Incidente reportado el {{ date('d/m/Y', strtotime($incidente_estudiantil->fecha_incidente)) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card border-0 bg-light mb-3">
                        <div class="card-header border-bottom bg-light">
                            <h6 class="mb-0 fw-bold text-uppercase">Datos del Docente</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                
                                <div>
                                    <h6 class="mb-0">{{ $incidente_estudiantil->docente->nombre }} {{ $incidente_estudiantil->docente->apellido }}</h6>
                                    <small class="text-muted">Docente responsable</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-0 bg-light">
                        <div class="card-header border-bottom bg-light">
                            <h6 class="mb-0 fw-bold text-uppercase">Datos del Estudiante</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-1"><i class="fas fa-user me-2 text-secondary"></i> <strong>Nombre:</strong> {{ $incidente_estudiantil->nombre }} {{ $incidente_estudiantil->apellido }}</div>
                            <div class="mb-1"><i class="fas fa-id-card me-2 text-secondary"></i> <strong>Cédula:</strong> {{ $incidente_estudiantil->cedula }}</div>
                            <div class="mb-1"><i class="fas fa-graduation-cap me-2 text-secondary"></i> <strong>Carrera:</strong> {{ $incidente_estudiantil->carrera }}</div>
                            <div class="mb-0"><i class="fas fa-layer-group me-2 text-secondary"></i> <strong>Semestre:</strong> {{ $incidente_estudiantil->semestre }}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 bg-light mb-4">
                        <div class="card-header border-bottom bg-light">
                            <h6 class="mb-0 fw-bold text-uppercase">Detalles del Incidente</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Incidente:</label>
                                <p class="py-2 px-3 bg-white rounded border">{{ $incidente_estudiantil->incidente }}</p>
                            </div>
                            <div>
                                <label class="form-label fw-bold">Descripción:</label>
                                <p class="py-3 px-3 bg-white rounded border" style="min-height: 100px;">{{ $incidente_estudiantil->descripcion }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.incidente-estudiantil.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Volver
                </a>
                <div>
                    <a href="{{ route('admin.incidente-estudiantil.edit', $incidente_estudiantil->id) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-1"></i> Editar
                    </a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fas fa-trash-alt me-1"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal de confirmación para eliminar -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro que desea eliminar este registro de incidente? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('admin.incidente-estudiantil.destroy', $incidente_estudiantil->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>