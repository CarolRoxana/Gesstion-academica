<x-admin>
    @section('title', 'Licencias Docentes')

    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.licencia_docentes.create') }}" class="btn btn-primary mb-3">Crear Licencia</a>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Docente</th>
                        <th>Curso</th>
                        <th>Institución</th>
                        <th>Tipo</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($licencias as $licencia)
                        <tr>
                            <td>{{ $licencia->user->name }}</td>
                            <td>{{ $licencia->nombre_curso }}</td>
                            <td>{{ $licencia->institucion }}</td>
                            <td>{{ $licencia->tipo_curso }}</td>
                            <td>{{ $licencia->fecha_inicio }}</td>
                            <td>{{ $licencia->fecha_fin }}</td>
                            <td>{{ $licencia->estatus }}</td>
                            <td>
                                <a href="{{ route('admin.licencia_docentes.show', $licencia->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('admin.licencia_docentes.edit', $licencia->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('admin.licencia_docentes.destroy', $licencia->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
