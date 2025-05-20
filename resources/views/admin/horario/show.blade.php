<x-admin>
    @section('title', 'Detalle del Horario')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalle del Horario</h3>
            <a href="{{ route('admin.horario.index') }}" class="btn btn-sm btn-secondary float-right">Volver</a>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>Docente:</strong> {{ $horario->docente->nombre }}
                    {{ $horario->docente->apellido }}</li>
                <li class="list-group-item"><strong>Unidad Curricular:</strong> {{ $horario->unidadCurricular->nombre }}
                </li>
                <li class="list-group-item"><strong>Día:</strong> {{ $horario->dia }}</li>
                <li class="list-group-item"><strong>Inicio:</strong>
                    {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}</li>
                <li class="list-group-item"><strong>Fin:</strong>
                    {{ \Carbon\Carbon::parse($horario->hora_finalizacion)->format('H:i') }}</li>
                <li class="list-group-item"><strong>Sección:</strong> {{ $horario->seccion->nombre }}</li>
                <li class="list-group-item"><strong>Período Académico:</strong>
                    {{ $horario->periodoAcademico->periodo }}</li>
                <li class="list-group-item"><strong>Sede:</strong> {{ $horario->sede }}</li>

                {{-- COLOCAR MODULO Y PISO --}}
                <li class="list-group-item"><strong>Módulo:</strong> {{ $horario->modulo }}</li>
                <li class="list-group-item"><strong>Piso:</strong> {{ $horario->piso }}</li>

                <li class="list-group-item"><strong>Aula:</strong>
                    @if ($horario->sede === 'Atlantico')
                        {{ \App\Helpers\ArrayHelper::descripcionAulaAtlanticoPorId($horario->aula_id) }}
                    @elseif($horario->sede === 'Villa Asia')
                        {{ \App\Helpers\ArrayHelper::descripcionAulaVillasiaPorId($horario->aula_id) }}
                    @endif
                </li>
            </ul>
        </div>
    </div>
</x-admin>
