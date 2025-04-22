<x-admin>
    @section('title', 'Detalle del Talento Humano')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalle del Talento Humano</h3>
            <a href="{{ route('admin.talento_humano.index') }}" class="btn btn-sm btn-secondary float-right">Volver</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Información Personal</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Nombre Completo:</strong> 
                                {{ $talentoHumano->nombre }} {{ $talentoHumano->apellido }}
                            </li>
                            <li class="list-group-item">
                                <strong>Cédula:</strong> {{ $talentoHumano->cedula }}
                            </li>
                            <li class="list-group-item">
                                <strong>Correo Electrónico:</strong> 
                                <a href="mailto:{{ $talentoHumano->correo }}">{{ $talentoHumano->correo }}</a>
                            </li>
                            <li class="list-group-item">
                                <strong>Teléfono:</strong> 
                                {{ $talentoHumano->telefono ?? 'No especificado' }}
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Información de Postulación</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Fecha de Postulación:</strong> 
                                {{ \Carbon\Carbon::parse($talentoHumano->fecha_postulacion)->format('d/m/Y') }}
                            </li>
                            <li class="list-group-item">
                                <strong>Estatus:</strong>
                                <span class="badge 
                                    @if($talentoHumano->estatus == 'Aprobado') badge-success
                                    @elseif($talentoHumano->estatus == 'Pendiente') badge-warning
                                    @elseif($talentoHumano->estatus == 'Rechazado') badge-danger
                                    @else badge-secondary
                                    @endif">
                                    {{ $talentoHumano->estatus }}
                                </span>
                            </li>
                            <li class="list-group-item">
                                <strong>Carrera:</strong> 
                                {{ $talentoHumano->carrera_postulacion }}
                            </li>
                            <li class="list-group-item">
                                <strong>Unidad Curricular:</strong> 
                                {{ $talentoHumano->unidad_curricular_postulacion }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Fechas Clave</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Fecha de Aprobación:</strong> 
                                {{ $talentoHumano->fecha_aprobacion ? \Carbon\Carbon::parse($talentoHumano->fecha_aprobacion)->format('d/m/Y') : 'No aprobado' }}
                            </li>
                            <li class="list-group-item">
                                <strong>Fecha de Ingreso:</strong> 
                                {{ \Carbon\Carbon::parse($talentoHumano->fecha_ingreso)->format('d/m/Y') }}
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Detalles Adicionales</h4>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Motivo:</strong> 
                                {{ $talentoHumano->motivo }}
                            </li>
                            <li class="list-group-item">
                                <strong>Observaciones:</strong> 
                                {{ $talentoHumano->observaciones ?? 'Ninguna' }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="mt-3 d-flex justify-content-end">
                <a href="{{ route('admin.talento_humano.edit', $talentoHumano->id) }}" class="btn btn-warning mr-2">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <form action="{{ route('admin.talento_humano.destroy', $talentoHumano->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin>