<x-admin>
    @section('title', 'Horarios')
    
    <h1>Horarios</h1>
    
    <form method="GET" action="{{ route('admin.horarios.index') }}" class="mb-3">
        <label for="docente_id">Filtrar por Docente:</label>
        <select name="docente_id" id="docente_id" class="form-control w-auto d-inline-block">
            <option value="">-- Todos --</option>
            @foreach ($docentes as $docente)
                <option value="{{ $docente->id }}" {{ request('docente_id') == $docente->id ? 'selected' : '' }}>
                    {{ $docente->nombre }} {{ $docente->apellido }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Docente</th>
                <th>Día</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Unidad Curricular</th>
                <th>Sección</th>
                <th>Período Académico</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $horario)
            <tr>
                <td>{{ $horario->docente->nombre }} {{ $horario->docente->apellido }}</td>
                <td>{{ \Carbon\Carbon::parse($horario->dia)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($horario->hora_finalizacion)->format('H:i') }}</td>
                <td>{{ $horario->unidadCurricular->nombre }}</td>
                <td>{{ $horario->seccion }}</td>
                <td>{{ $horario->periodoAcademico->nombre }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </x-admin>
    