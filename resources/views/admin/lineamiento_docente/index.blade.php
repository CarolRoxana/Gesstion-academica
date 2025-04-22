<x-admin>
    @section('title', 'Lineamientos Docentes')

    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.lineamiento-docente.create') }}" class="btn btn-primary mb-3">Crear Lineamiento</a>
            
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Docente</th>
                        <th>Fecha Supervisión</th>
                        <th>Resumen</th>
                        <th>Cumple Lineamientos</th>
                        <th>Periodo Académico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lineamientos as $lineamiento)
                        <tr>
                            <td>{{ $lineamiento->docente->nombre }} {{ $lineamiento->docente->apellido }}</td>
                            <td>{{ $lineamiento->fecha_supervision }}</td>
                            <td>{{ $lineamiento->resumen }}</td>
                            <td>{{ $lineamiento->cumple_lineamientos }}</td>
                            <td>{{ $lineamiento->periodoAcademico->periodo }}</td>
                            <td>
                                <a href="{{ route('admin.lineamiento-docente.edit', $lineamiento->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('admin.lineamiento-docente.destroy', $lineamiento->id) }}" method="POST" class="d-inline-block">
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
