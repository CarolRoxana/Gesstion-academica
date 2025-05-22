<x-admin>
    @section('title', 'Propuestas de Trabajo de Pasantía')

    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.propuesta_tp.create') }}" class="btn btn-primary mb-3">Crear Propuesta</a>
            <a href="{{ route('admin.admin.propuestas.pasantia.pdf') }}" class="btn btn-success mb-3">
                <i class="fas fa-file-pdf"></i> Exportar Pasantías
            </a>
            
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <a href="{{ route('admin.propuestas.pasantia.pdf') }}" class="btn btn-success mb-3">
                <i class="fas fa-file-pdf"></i> Exportar Pasantías
            </a>
            <table class="table table-bordered">
                <thead class="table-light text-uppercase small">
                    <tr>
                        <th scope="col" style="width:18%;">Nombre(s) Pasante(s)</th>
                        <th scope="col" style="width:22%;">Título de Propuesta</th>
                        <th scope="col" style="width:18%;">Docente Tutor</th>
                        <th scope="col" style="width:10%;">Estatus</th>
                        <th scope="col" style="width:12%;">Fecha Ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                @if(count($propuestas) > 0)    
                <tbody>
                    @foreach ($propuestas as $propuesta)
                        <tr>
                            <td>
                                {{ $propuesta->nombre_pasante }} {{ $propuesta->apellido_pasante }}
                                
                                @if(isset($propuesta->nombre_pasante2) && !empty($propuesta->nombre_pasante2))
                                    <br>{{ $propuesta->nombre_pasante2 }} {{ $propuesta->apellido_pasante2 }}
                                @endif
                                
                                @if(isset($propuesta->nombre_pasante3) && !empty($propuesta->nombre_pasante3))
                                    <br>{{ $propuesta->nombre_pasante3 }} {{ $propuesta->apellido_pasante3 }}
                                @endif
                            </td>
                            <td>{{ $propuesta->titulo_propuesta }}</td>
                            <td>{{ $propuesta->docente->nombre }} {{ $propuesta->docente->apellido }}</td>
                            <td>{{ $propuesta->estatus }}</td>
                            <td>{{ \Carbon\Carbon::parse($propuesta->fecha_ingreso)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.propuesta_tp.show', $propuesta->id) }}" class="btn btn-sm btn-success">Ver</a>
                                <a href="{{ route('admin.propuesta_tp.edit', $propuesta->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('admin.propuesta_tp.destroy', $propuesta->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                @else
                 <li class="list-group-item text-center text-muted">
                    <i class="fas fa-info-circle me-2"></i>No hay propuestas de pasantías registradas.
                </li>
                @endif
            </table>
        </div>
    </div>
</x-admin>
