<x-admin>
    @section('title','Detalle Servicio')

    @section('content_header')
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Detalle de Servicio Comunitario</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.servicio_comunitario.index') }}">Servicios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                </ol>
            </nav>
        </div>
    @endsection

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-primary text-white py-3">
                                <h4 class="mb-0"><i class="fas fa-file-alt me-2"></i>   {{ $servicio->titulo_servicio }}  </h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                <div class="d-flex align-items-center mb-2">
                    <div class="bg-light rounded-circle p-2 me-3">
                        <i class="fas fa-user-graduate text-primary"></i>
                    </div>
                    <h5 class="mb-0">
                        Información {{ isset($servicio->nombre_estudiante2) || isset($servicio->nombre_estudiante3) ? 'de los Estudiantes' : 'del Estudiante' }}
                    </h5>
                </div>
                {{-- Estudiante 1 --}}
                <div class="ps-5 border-start border-2 border-light ms-2 mt-3">
                    @if(isset($servicio->nombre_estudiante2) || isset($servicio->nombre_estudiante3) || isset($servicio->nombre_estudiante4) || isset($servicio->nombre_estudiante5))
                        <h6 class="fw-bold mb-2">Estudiante 1</h6>
                    @endif
                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Nombre completo:</div>
                        <div class="col-md-9 fw-bold">{{ $servicio->nombre_estudiante }} {{ $servicio->apellido_estudiante }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Cédula:</div>
                        <div class="col-md-9">{{ $servicio->cedula }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Carrera:</div>
                        <div class="col-md-9">{{ \App\Helpers\ArrayHelper::carrerasPorId($servicio->carrera) }}</div>
                    </div>
                </div>
                {{-- Estudiantes 2 a 6 --}}
                @for ($i = 2; $i <= 6; $i++)
                    @php
                        $nombre = 'nombre_estudiante' . $i;
                        $apellido = 'apellido_estudiante' . $i;
                        $cedula = 'cedula' . $i;
                        $carrera = 'carrera' . $i;
                    @endphp
                    @if(!empty($servicio->$nombre))
                        <div class="ps-5 border-start border-2 border-light ms-2 mt-4">
                            <h6 class="fw-bold mb-2">Estudiante {{ $i }}</h6>
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Nombre completo:</div>
                                <div class="col-md-9 fw-bold">{{ $servicio->$nombre }} {{ $servicio->$apellido }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Cédula:</div>
                                <div class="col-md-9">{{ $servicio->$cedula }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Carrera:</div>
                                <div class="col-md-9">{{ \App\Helpers\ArrayHelper::carrerasPorId($servicio->$carrera) }}</div>
                            </div>
                        </div>
                    @endif
                @endfor
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
                                <div class="col-md-9">{{ $servicio->docente->nombre }} {{ $servicio->docente->apellido }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-light rounded-circle p-2 me-3">
                                <i class="fas fa-info-circle text-primary"></i>
                            </div>
                            <h5 class="mb-0">Detalles del Servicio</h5>
                        </div>
                        <div class="ps-5 border-start border-2 border-light ms-2 mt-3">
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Fecha ingreso:</div>
                                <div class="col-md-9">
                                    <i class="far fa-calendar-alt me-1 text-secondary"></i>
                                    {{ \Carbon\Carbon::parse($servicio->fecha_ingreso)->format('d-m-Y') }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 text-muted">Estatus:</div>
                                @php
                                    $badge = ['aprobado'=>'success','rechazado'=>'danger','pendiente'=>'warning','proceso'=>'info'][$servicio->estatus] ?? 'secondary';
                                @endphp
                                <div class="col-md-9">
                                    <span class="badge bg-{{ $badge }} p-2 text-capitalize">
                                        <i class="fas fa-circle me-1"></i>{{ $servicio->estatus }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 text-muted">Archivo:</div>
                                <div class="col-md-9">
                                    @if ($servicio->trabajo_servicio)
                                        <a href="{{ asset('storage/' . $servicio->trabajo_servicio) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-file-pdf me-1"></i> Ver PDF
                                        </a>
                                    @else
                                        <span class="text-muted"><i class="fas fa-exclamation-circle me-1"></i> No disponible</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ url()->previous() }} " class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Volver
                    </a>
                    <a href="{{ route('admin.servicio_comunitario.edit', $servicio) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i> Editar
                    </a>
                </div>
            </div>
        </div>

        {{-- Resumen lateral --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Resumen</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-calendar-day text-primary me-2"></i>Ingreso</span>
                            <span class="badge bg-light text-dark">{{ \Carbon\Carbon::parse($servicio->fecha_ingreso)->format('d-m-Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-user-check text-primary me-2"></i>Estado</span>
                            <span class="badge bg-{{ $badge }}">{{ $servicio->estatus }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fas fa-graduation-cap text-primary me-2"></i>Carrera</span>
                            <div class="col-md-9">{{\App\Helpers\ArrayHelper::carrerasPorId ($servicio->carrera) }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-admin>
