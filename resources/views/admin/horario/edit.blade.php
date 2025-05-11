<x-admin>
    @section('title', 'Editar Horario')

    <h1>Editar Horario</h1>

    <form action="{{ route('admin.horario.update', $horario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="docente_id">Docente</label>
            <select name="docente_id" class="form-control" required>
                @foreach ($docentes as $docente)
                    <option value="{{ $docente->id }}" {{ $horario->docente_id == $docente->id ? 'selected' : '' }}>
                        {{ $docente->nombre }} {{ $docente->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="dia">Día</label>
            <select name="dia" class="form-control" required>
                @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dia)
                    <option value="{{ $dia }}" {{ $horario->dia == $dia ? 'selected' : '' }}>{{ $dia }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="hora_inicio">Hora de inicio</label>
            <input type="time" name="hora_inicio" class="form-control"
                value="{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}" required>
        </div>

        <div class="form-group">
            <label for="hora_finalizacion">Hora de finalización</label>
            <input type="time" name="hora_finalizacion" class="form-control"
                value="{{ \Carbon\Carbon::parse($horario->hora_finalizacion)->format('H:i') }}" required>
        </div>

        <div class="form-group">
            <label for="unidad_curricular_id">Unidad Curricular</label>
            <select name="unidad_curricular_id" id="unidad_curricular_id" class="form-control" required>
                @foreach ($unidades as $unidad)
                    <option value="{{ $unidad->id }}" {{ $horario->unidad_curricular_id == $unidad->id ? 'selected' : '' }}>
                        {{ $unidad->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="seccion_id">Sección</label>
            <select name="seccion_id" id="seccion_id" class="form-control" required>
                {{-- Secciones se cargarán dinámicamente --}}
                <option value="">Seleccione una sección</option>
                @foreach ($secciones as $seccion)
                    @if ($seccion->unidad_curricular_id == $horario->unidad_curricular_id)
                        <option value="{{ $seccion->id }}" {{ $horario->seccion_id == $seccion->id ? 'selected' : '' }}>
                            {{ $seccion->nombre }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="periodo_academico_id">Período Académico</label>
            <select name="periodo_academico_id" class="form-control" required>
                @foreach ($periodos as $periodo)
                    <option value="{{ $periodo->id }}" {{ $horario->periodo_academico_id == $periodo->id ? 'selected' : '' }}>
                        {{ $periodo->periodo }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar Horario</button>
    </form>

    {{-- Script para actualizar secciones según la unidad curricular --}}
    <script>
        document.getElementById('unidad_curricular_id').addEventListener('change', function () {
            const unidadId = this.value;
            const seccionSelect = document.getElementById('seccion_id');
            seccionSelect.innerHTML = '<option value="">Cargando secciones...</option>';

            if (unidadId) {
                fetch(`/admin/unidad-curricular/${unidadId}/secciones`)
                    .then(res => res.json())
                    .then(secciones => {
                        seccionSelect.innerHTML = '<option value="">Seleccione una sección</option>';
                        secciones.forEach(seccion => {
                            const option = document.createElement('option');
                            option.value = seccion.id;
                            option.text = seccion.nombre;
                            seccionSelect.appendChild(option);
                        });
                    })
                    .catch(() => {
                        seccionSelect.innerHTML = '<option value="">Error al cargar</option>';
                    });
            } else {
                seccionSelect.innerHTML = '<option value="">Seleccione una unidad curricular primero</option>';
            }
        });
    </script>
</x-admin>
