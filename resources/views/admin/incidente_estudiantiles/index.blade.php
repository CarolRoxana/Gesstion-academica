<x-admin>
    @section('title', 'Incidencias Académicas')

    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.incidente-estudiantil.create') }}" class="btn btn-primary mb-3">Registrar Incidente</a>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Docente</th>
                        <th>Estudiante</th>
                        <th>Carrera</th>
                        <th>Incidente</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($incidentes as $incidente)
                        <tr>
                            <td>{{ $incidente->docente->nombre }}</td>
                            <td>{{ $incidente->nombre }} {{ $incidente->apellido }}</td>
                            <td>{{ $incidente->carrera }}</td>
                            <td>{{ $incidente->incidente }}</td>
                            <td>{{ $incidente->fecha_incidente }}</td>
                            <td>
                                <a href="{{ route('admin.incidente-estudiantil.show', $incidente) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('admin.incidente-estudiantil.edit', $incidente) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('admin.incidente-estudiantil.destroy', $incidente) }}" method="POST" class="d-inline-block">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
