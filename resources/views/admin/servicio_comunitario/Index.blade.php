<x-admin>
    @section('title', 'Servicio Comunitario')

    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.servicio_comunitario.create') }}"class="btn btn-primary mb-3">
                Nuevo servicio
            </a>
        </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

        <div class="card-body p-0">
                <table class="table table-bordered">
                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th scope="col" style="width:18%;">Nombre Estudiante(s)</th>
                            <th scope="col" style="width:22%;">Título del servicio comunitario</th>
                            <th scope="col" style="width:18%;">Docente Tutor</th>
                            <th scope="col" style="width:10%;">Estatus</th>
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
                                    <a href="{{ route('admin.servicio_comunitario.show',  $servicio->id) }}"
                                       class="btn btn-sm btn-success" title="Ver detalle">
                                        Ver
                                    </a>

                                    <a href="{{ route('admin.servicio_comunitario.edit',  $servicio->id) }}"
                                       class="btn btn-sm btn-primary" title="Editar">
                                        Editar
                                    </a>

                                    <!-- Botón que abre el modal -->
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $servicio->id }}"
                                    >
                                        Eliminar
                                    </button>

                                    <!-- Modal con formulario de eliminación -->
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
                                                    <form action="{{ route('admin.servicio_comunitario.destroy', $servicio) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
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

        @if(method_exists($servicios, 'links'))
            <div class="card-footer">
                {{ $servicios->links() }}
            </div>
        @endif
    </div>
</x-admin>
