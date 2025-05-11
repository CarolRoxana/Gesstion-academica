<x-admin>
    @section('title', 'Unidades Curriculares por Periodo')

    <div class="mb-3">
        <a href="{{ route('admin.unidad-curricular-periodo.create') }}" class="btn btn-success">Nueva Asignación</a>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Unidad Curricular</th>
                        <th>Periodo</th>
                        <th>Sede</th>
                        <th>Modalidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registros as $registro)
                        <tr>
                            <td>{{ $registro->id }}</td>
                            <td>{{ $registro->unidadCurricular->nombre }}</td>
                            <td>{{ $registro->periodoAcademico->periodo }}</td>
                            <td>{{ $registro->sede }}</td>
                            <td>{{ $registro->modalidad }}</td>
                            <td>
                                <a href="{{ route('admin.unidad-curricular-periodo.show', $registro->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('admin.unidad-curricular-periodo.edit', $registro->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('admin.unidad-curricular-periodo.destroy', $registro->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
