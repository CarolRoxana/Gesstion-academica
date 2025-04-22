<x-admin>
    @section('title', 'Detalle del Horario')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalle del Horario</h3>
            <a href="{{ route('admin.horario.index') }}" class="btn btn-sm btn-secondary float-right">Volver</a>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>Docente:</strong> {{ $horario->docente->nombre }} {{ $horario->docente->apellido }}</li>
                <li class="list-group-item"><strong>Unidad Curricular:</strong> {{ $horario->unidadCurricular->nombre }}</li>
                <li class="list-group-item"><strong>Día:</strong> {{ $horario->dia->format('d/m/Y') }}</li>
                <li class="list-group-item"><strong>Inicio:</strong> {{ $horario->hora_inicio->format('H:i') }}</li>
                <li class="list-group-item"><strong>Fin:</strong> {{ $horario->hora_finalizacion->format('H:i') }}</li>
                <li class="list-group-item"><strong>Sección:</strong> {{ $horario->seccion }}</li>
                <li class="list-group-item"><strong>Período Académico:</strong> {{ $horario->periodoAcademico->periodo }}</li>
            </ul>
        </div>
    </div>
</x-admin>
