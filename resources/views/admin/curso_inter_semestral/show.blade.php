<x-admin>
    @section('title', 'Detalle del Curso Intersemestral')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalle del Curso</h3>
            <a href="{{ route('admin.curso-inter-semestral.index') }}" class="btn btn-sm btn-secondary float-right">Volver</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Información Básica</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Nombre del Curso:</strong> 
                                {{ $curso->nombre_curso }}
                            </li>
                            <li class="list-group-item">
                                <strong>Docente Responsable:</strong> 
                                {{ $curso->docente->nombre ?? 'N/A' }} {{ $curso->docente->apellido ?? 'N/A' }}
                            </li>
                            <li class="list-group-item">
                                <strong>Modalidad:</strong>
                                <span class="badge 
                                    @if($curso->modalidad == 'Presencial') badge-primary
                                    @elseif($curso->modalidad == 'Virtual') badge-info
                                    @elseif($curso->modalidad == 'Híbrido') badge-success
                                    @else badge-secondary
                                    @endif">
                                    {{ $curso->modalidad }}
                                </span>
                            </li>
                            <li class="list-group-item">
                                <strong>Exponente/Instructor:</strong> 
                                {{ $curso->exponente ?? 'No especificado' }}
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Fechas y Cupos</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Fecha de Inicio:</strong> 
                                {{ \Carbon\Carbon::parse($curso->fecha_inicio)->isoFormat('dddd D [de] MMMM [de] YYYY') }}
                            </li>
                            <li class="list-group-item">
                                <strong>Fecha de Fin:</strong> 
                                {{ \Carbon\Carbon::parse($curso->fecha_fin)->isoFormat('dddd D [de] MMMM [de] YYYY') }}
                            </li>
                            <li class="list-group-item">
                                <strong>Duración:</strong> 
                                {{ \Carbon\Carbon::parse($curso->fecha_inicio)->diffInDays($curso->fecha_fin) + 1 }} días
                            </li>
                            <li class="list-group-item">
                                <strong>Cupos Máximos:</strong> 
                                {{ $curso->cupos_max }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Descripción y Estatus</h4>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Descripción del Curso</h5>
                            <p class="card-text">{{ $curso->descripcion }}</p>
                            
                            <hr>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Estatus Actual:</h5>
                                </div>
                                <div>
                                    <span class="badge 
                                        @if($curso->estatus == 'Activo') badge-success
                                        @elseif($curso->estatus == 'Programado') badge-info
                                        @elseif($curso->estatus == 'Cancelado') badge-danger
                                        @elseif($curso->estatus == 'Completado') badge-primary
                                        @else badge-secondary
                                        @endif" style="font-size: 1rem;">
                                        {{ $curso->estatus }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-3 d-flex justify-content-end">
                <a href="{{ route('admin.curso-inter-semestral.edit', $curso->id) }}" class="btn btn-warning mr-2">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <form action="{{ route('admin.curso-inter-semestral.destroy', $curso->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este curso?')">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin>