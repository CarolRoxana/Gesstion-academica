<x-admin>
    @section('title', 'Servicio Comunitario')

    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.servicio_comunitario.create') }}"class="btn btn-sm btn-primary mb-3">
                <i class="fas fa-plus-circle me-1"></i> Nuevo servicio
            </a>
        </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

        <div class="card-body p-0">
                <table class="table table-bordered">
                    <thead class=" text-uppercase small">
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
                                   {{ $servicio->nombre_estudiante }} {{ $servicio->apellido_estudiante }}
                                    @for ($i = 2; $i <= 5; $i++)
                                        @php
                                            $nombre = 'nombre_estudiante' . $i;
                                            $apellido = 'apellido_estudiante' . $i;
                                        @endphp
                                        @if(!empty($servicio->$nombre))
                                            <br>{{ $servicio->$nombre }} {{ $servicio->$apellido }}
                                        @endif
                                    @endfor
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
                                    <form action="{{ route('admin.servicio_comunitario.destroy', $servicio->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este servicio comunitario?')">
                                            Eliminar
                                        </button>
                                    </form>
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
