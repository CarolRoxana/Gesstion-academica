<x-admin>
    @section('title', 'Servicio Comunitario')

    @section('content_header')
        <div class="d-flex justify-content-between align-items-center">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Servicios comunitarios
                    </li>
                </ol>
            </nav>
        </div>
    @endsection


    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.servicio_comunitario.create') }}"  class="btn btn-sm btn-success">
                Nuevo servicio
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th scope="col" style="width:18%;">Estudiante</th>
                            <th scope="col" style="width:22%;">Título del servicio comunitario</th>
                            <th scope="col" style="width:18%;">Tutor</th>
                            <th scope="col" style="width:10%;">Estado</th>
                            <th scope="col" style="width:12%;">Ingreso</th>
                            <th scope="col" style="width:14%;" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($servicios as $index => $servicio)
                            @php
                                $badge = match(strtolower($servicio->estatus)) {
                                    'aprobada', 'aprobado'  => 'success',
                                    'rechazada', 'rechazado'=> 'danger',
                                    'pendiente'             => 'warning',
                                    default                 => 'secondary',
                                };
                            @endphp
                            <tr>

                                <td>
                                    {{ $servicio->nombre_estudiante }} {{ $servicio->apellido_estudiante }}<br>
                                </td>

                                <td>{{ Str::limit($servicio->titulo_servicio, 45) }}</td>

                                <td>
                                    @if($servicio->docente)
                                        {{ $servicio->docente->apellido }}, {{ $servicio->docente->nombre }}
                                    @else
                                        <span class="text-muted">Sin asignar</span>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-{{ $badge }} text-capitalize">
                                        <i class="fas fa-circle me-1"></i>{{ $servicio->estatus }}
                                    </span>
                                </td>

                                <td>{{ \Carbon\Carbon::parse($servicio->fecha_ingreso)->format('d/m/Y') }}</td>

                                <td class="text-end">
                                    <a  href="{{ route('admin.servicio_comunitario.show',  $servicio->id) }}"
                                        class="btn btn-sm btn-success" title="Ver detalle">
                                        Ver
                                    </a>

                                    <a  href="{{ route('admin.servicio_comunitario.edit',  $servicio->id) }}"
                                        class="btn btn-sm btn-primary" title="Editar">
                                        Editar
                                    </a>

                                    <form action="{{ route('admin.servicio_comunitario.destroy', $servicio) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>

                                    <div class="modal fade" id="deleteModal{{ $servicio->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-triangle-exclamation me-2"></i>Confirmar eliminación
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Seguro que deseas eliminar el servicio comunitario
                                                    <strong>“{{ $servicio->titulo_servicio }}”</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Cancelar
                                                    </button>
                                                     
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <em>No hay servicios comunitarios registrados.</em>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(method_exists($servicios, 'links'))
            <div class="card-footer">
                {{ $servicios->links() }}
            </div>
        @endif
    </div>
</x-admin>
