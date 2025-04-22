<x-admin>
@section('title', 'Desempeño  Docentes')
    <a href="{{ route('admin.desempeno-docente.create') }}" class="btn btn-primary mb-3">Nuevo Desempeño</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-3 d-flex gap-2">
        <select name="docente_id" class="form-select w-auto">
            <option value="">Todos los docentes</option>
            @foreach ($docentes as $docente)
                <option value="{{ $docente->id }}" {{ request('docente_id') == $docente->id ? 'selected' : '' }}>
                    {{ $docente->nombre }} {{ $docente->apellido }}
                </option>
            @endforeach
        </select>
    
        <button class="btn btn-secondary">Filtrar</button>
    </form>    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Docente</th>
                <th>Unidad Curricular</th>
                <th>Puntualidad</th>
                <th>Calidad de Enseñanza</th>
                <th>Participación en Proyectos</th>
                <th>Cumplimiento Administrativo</th>
                <th>Evaluado Por</th>
                <th>Fecha de Evaluación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($desempenos as $desempeno)
            <tr>
                <td>{{ $desempeno->docente->nombre }} {{ $desempeno->docente->apellido }}</td>
                <td>{{ $desempeno->unidadCurricularPeriodoAcademico->unidadCurricular->nombre }}</td>
                <td>{{ $desempeno->puntualidad }}</td>
                <td>{{ $desempeno->calidad_ensenanza }}</td>
                <td>{{ $desempeno->participacion_proyectos }}</td>
                <td>{{ $desempeno->cumplimiento_administrativo }}</td>
                <td>{{ $desempeno->evaluado_por }}</td>
                <td>{{ \Carbon\Carbon::parse($desempeno->fecha_evaluacion)->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin.desempeno-docente.edit', $desempeno->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.desempeno-docente.destroy', $desempeno->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-admin>