<x-admin>
    @section('title', 'Docentes')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Docentes</h3>
            <div class="card-tools">
                <a href="{{ route('admin.docente.create') }}" class="btn btn-sm btn-info">Nuevo</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="docenteTable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docentes as $docente)
                        <tr>
                            <td>{{ $docente->nombre }}</td>
                            <td>{{ $docente->apellido }}</td>
                            <td>{{ $docente->cedula }}</td>
                            <td>{{ $docente->correo }}</td>
                            <td>{{ $docente->telefono }}</td>
                            <td>
                                <a href="{{ route('admin.docente.show', $docente->id) }}" class="btn btn-sm btn-success">Ver</a>
                                <a href="{{ route('admin.docente.edit', $docente->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('admin.docente.destroy', $docente->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('¿Seguro que desea eliminar este docente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @section('js')
        <script>
            $(function () {
                $('#docenteTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    responsive: true,
                });
            });
        </script>
    @endsection
</x-admin>