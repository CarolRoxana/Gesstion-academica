<x-admin>
    @section('title', 'Propuestas de Trabajo de Pasantía')

    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.propuesta_tp.create') }}" class="btn btn-primary mb-3">Crear Propuesta</a>
            
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <a href="{{ route('admin.admin.propuestas.pasantia.pdf') }}" class="btn btn-success mb-3">
                <i class="fas fa-file-pdf"></i> Exportar Pasantías
            </a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre Pasante</th>
                        <th>Título de Propuesta</th>
                        <th>Docente Tutor</th>
                        <th>Estatus</th>
                        <th>Fecha Ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($propuestas as $propuesta)
                        <tr>
                            <td>{{ $propuesta->nombre_pasante }} {{ $propuesta->apellido_pasante }}</td>
                            <td>{{ $propuesta->titulo_propuesta }}</td>
                            <td>{{ $propuesta->docente->nombre }} {{ $propuesta->docente->apellido }}</td>
                            <td>{{ $propuesta->estatus }}</td>
                            <td>{{ $propuesta->fecha_ingreso }}</td>
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
            </table>
        </div>
    </div>
</x-admin>
