<x-admin>
    @section('title', 'Listado de Talento Humano')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.talento_humano.create') }}" class="btn btn-primary">Nuevo Talento Humano</a>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Correo</th>
                        <th>Fecha de Postulación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($talentoHumano as $persona)
                        <tr>
                            <td>{{ $persona->nombre }} {{ $persona->apellido }}</td>
                            <td>{{ $persona->cedula }}</td>
                            <td>{{ $persona->correo }}</td>
                            <td>{{ $persona->fecha_postulacion }}</td>
                            <td>
                                <a href="{{ route('admin.talento_humano.show', $persona->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('admin.talento_humano.edit', $persona->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('admin.talento_humano.destroy', $persona->id) }}" method="POST" style="display:inline;">
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
