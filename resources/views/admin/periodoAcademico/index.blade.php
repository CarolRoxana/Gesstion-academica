<x-admin>
    @section('title', 'Periodos Académicos')

    <div class="d-flex justify-content-between mb-3">
        <h2>Lista de Periodos Académicos</h2>
        <a href="{{ route('admin.periodo-academico.create') }}" class="btn btn-success">Nuevo Periodo</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Periodo</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Finalización</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($periodos as $periodo)
                <tr>
                    <td>{{ $periodo->periodo }}</td>
                    <td>{{ \Carbon\Carbon::parse($periodo->fecha_inicio)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($periodo->fecha_finalizacion)->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('admin.periodo-academico.show', $periodo) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('admin.periodo-academico.edit', $periodo) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('admin.periodo-academico.destroy', $periodo) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este periodo?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin>
