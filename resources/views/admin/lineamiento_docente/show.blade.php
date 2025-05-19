<x-admin>
@section('title', 'Detalle Lineamiento Docente')

<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">
            <i class="fas fa-clipboard-check me-2"></i>
            Supervisión – {{ $lineamiento->docente->nombre }} {{ $lineamiento->docente->apellido }}
        </h4>

        <div>
            <a href="{{ route('admin.lineamiento-docente.edit', $lineamiento->id) }}" 
               class="btn btn-light btn-sm me-2">
                <i class="fas fa-edit me-1"></i>Editar
            </a>

            <a href="{{ url()->previous() }}" 
               class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left me-1"></i>Volver
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="row gy-4">
            <!-- Información General -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Información General</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Docente:</strong>
                            <div class="mt-1">{{ $lineamiento->docente->nombre }} {{ $lineamiento->docente->apellido }}</div>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Fecha de Supervisión:</strong>
                            <div class="mt-1">{{ \Carbon\Carbon::parse($lineamiento->fecha_supervision)->format('d/m/Y') }}</div>
                        </div>
                        
                        <div>
                            <strong>Periodo Académico:</strong>
                            <div class="mt-1">{{ $lineamiento->periodoAcademico->periodo }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Resultados</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Cumple Lineamientos:</strong>
                            <div class="mt-1">{{ $lineamiento->cumple_lineamientos }}</div>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Resumen:</strong>
                            <div class="mt-1">{{ $lineamiento->resumen }}</div>
                        </div>
                        
                        <div>
                            <strong>Observaciones:</strong>
                            <div class="mt-1">{{ $lineamiento->observaciones ?: '—' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-admin>