{{-- filepath: resources/views/admin/horario/form.blade.php --}}
<form action="{{ $action }}" method="POST">
    @csrf
    @if(isset($method) && $method === 'PUT')
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="docente_id">Docente</label>
        <select name="docente_id" id="docente_id" class="form-control" required>
            <option value="">Seleccione un docente</option>
            @foreach ($docentes as $docente)
                <option value="{{ $docente->id }}"
                    {{ (isset($horario) && $horario->docente_id == $docente->id) ? 'selected' : '' }}>
                    {{ $docente->nombre }} {{ $docente->apellido }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="dia">Día de la semana</label>
        <select name="dia" id="dia" class="form-control" required>
            <option value="">Seleccione un día</option>
            @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dia)
                <option value="{{ $dia }}"
                    {{ (isset($horario) && $horario->dia == $dia) ? 'selected' : '' }}>
                    {{ $dia }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="hora_inicio">Hora de inicio</label>
        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control"
            value="{{ isset($horario) ? \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') : old('hora_inicio') }}" required>
    </div>

    <div class="form-group">
        <label for="hora_finalizacion">Hora de finalización</label>
        <input type="time" name="hora_finalizacion" id="hora_finalizacion" class="form-control"
            value="{{ isset($horario) ? \Carbon\Carbon::parse($horario->hora_finalizacion)->format('H:i') : old('hora_finalizacion') }}" required>
    </div>

    <div class="form-group">
        <label for="unidad_curricular_id">Unidad Curricular</label>
        <select name="unidad_curricular_id" id="unidad_curricular_id" class="form-control" required>
            <option value="">Seleccione una unidad</option>
            @foreach ($unidades as $unidad)
                <option value="{{ $unidad->id }}"
                    {{ (isset($horario) && $horario->unidad_curricular_id == $unidad->id) ? 'selected' : '' }}>
                    {{ $unidad->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="seccion_id">Sección</label>
        <select name="seccion_id" id="seccion_id" class="form-control" required>
            @if(isset($secciones) && isset($horario))
                @foreach ($secciones as $seccion)
                    @if ($seccion->unidad_curricular_id == $horario->unidad_curricular_id)
                        <option value="{{ $seccion->id }}"
                            {{ $horario->seccion_id == $seccion->id ? 'selected' : '' }}>
                            {{ $seccion->nombre }}
                        </option>
                    @endif
                @endforeach
            @else
                <option value="">Seleccione una unidad curricular primero</option>
            @endif
        </select>
    </div>

    <div class="form-group">
        <label for="periodo_academico_id">Período Académico</label>
        <select name="periodo_academico_id" id="periodo_academico_id" class="form-control" required>
            <option value="">Seleccione un período</option>
            @foreach ($periodos as $periodo)
                <option value="{{ $periodo->id }}"
                    {{ (isset($horario) && $horario->periodo_academico_id == $periodo->id) ? 'selected' : '' }}>
                    {{ $periodo->periodo }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-3">
        <button class="btn btn-success">{{ $btnText ?? 'Guardar Horario' }}</button>
       {{--  @if(isset($showButton) && $showButton)
          
        @endif --}}
          <button type="button" class="btn btn-primary mt-3" onclick="handle()">BUTTON</button>
    </div>
</form>

<script>
     function handle() {
            window.dispatchEvent(new CustomEvent('success', {
                detail: [{
                    title: 'Hola',
                    message: 'Mensaje de prueba'
                }]
            }));
        }

        document.getElementById('unidad_curricular_id').addEventListener('change', function() {
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