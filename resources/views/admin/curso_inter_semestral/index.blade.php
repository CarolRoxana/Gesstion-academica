<x-admin>
    @section('title', 'Cursos Intersemestrales')
    <div class="mb-3">
        <a href="{{ route('admin.curso-inter-semestral.create') }}" class="btn btn-primary">Nuevo Curso</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Docente</th>
                        <th>Modalidad</th>
                        <th>Fecha</th>
                        <th>Cupos</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $curso)
                        <tr>
                            <td>{{ $curso->nombre_curso }}</td>
                            <td>{{ $curso->docente->nombre ?? 'N/A' }} {{ $curso->docente->apellido ?? 'N/A' }}</td>
                            <td>{{ $curso->modalidad }}</td>
                            <td>{{ $curso->fecha_inicio }} - {{ $curso->fecha_fin }}</td>
                            <td>{{ $curso->cupos_max }}</td>
                            <td>{{ $curso->estatus }}</td>
                            <td>
                                <a href="{{ route('admin.curso-inter-semestral.show', $curso) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('admin.curso-inter-semestral.edit', $curso) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('admin.curso-inter-semestral.destroy', $curso) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar curso?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
