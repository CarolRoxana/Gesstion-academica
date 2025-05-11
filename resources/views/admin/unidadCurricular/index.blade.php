<x-admin>
    @section('title', 'Unidades Curriculares')

    <a href="{{ route('admin.unidad-curricular.create') }}" class="btn btn-primary mb-3">Nueva Unidad Curricular</a>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Unidad</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unidades as $unidad)
                        <tr>
                            <td>{{ $unidad->nombre }}</td>
                            <td>{{ $unidad->unidad_curricular }}</td>
                            <td>{{ $unidad->carrera }}</td>
                            <td>{{ $unidad->semestre }}</td>
                            <td>
                                <a href="{{ route('admin.unidad-curricular.edit', $unidad->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('admin.unidad-curricular.destroy', $unidad->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</button>
                                </form>
                                <a href="{{ route('admin.unidad-curricular.show', $unidad->id) }}" class="btn btn-sm btn-info">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
