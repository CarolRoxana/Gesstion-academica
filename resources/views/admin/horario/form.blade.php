<div class="form-group">
    <label for="docente_id">Docente</label>
    <select name="docente_id" id="docente_id" class="form-control" required>
        <option value="">Seleccione un docente</option>
        @foreach ($docentes as $docente)
            <option value="{{ $docente->id }}"
                {{ old('docente_id', isset($horario) ? $horario->docente_id : '') == $docente->id ? 'selected' : '' }}>
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
                {{ old('dia', isset($horario) ? $horario->dia : '') == $dia ? 'selected' : '' }}>
                {{ $dia }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="hora_inicio">Hora de inicio</label>
    <select name="hora_inicio" id="hora_inicio" class="form-control" required>
        <option value="">Seleccione un bloque</option>
        @php
            use Carbon\Carbon;
            $horarioHoraInicio = isset($horario) ? Carbon::parse($horario->hora_inicio)->format('H:i') : null;
        @endphp

        @foreach ($bloques as $bloque)
            @php
                $bloqueStart = Carbon::parse($bloque['start'])->format('H:i');
            @endphp
            <option value="{{ $bloque['start'] }}"
                {{ old('hora_inicio', $horarioHoraInicio) == $bloqueStart ? 'selected' : '' }}>
                {{ $bloque['start'] }} - {{ $bloque['end'] }}
            </option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <label for="hora_finalizacion">Hora de finalización</label>
    <select name="hora_finalizacion" id="hora_finalizacion" class="form-control" required>
        <option value="">Seleccione un bloque</option>
        @php
            $horarioHoraFin = isset($horario) ? Carbon::parse($horario->hora_finalizacion)->format('H:i') : null;
        @endphp

        @foreach ($bloques as $bloque)
            @php
                $bloqueEnd = Carbon::parse($bloque['end'])->format('H:i');
            @endphp
            <option value="{{ $bloque['end'] }}"
                {{ old('hora_finalizacion', $horarioHoraFin) == $bloqueEnd ? 'selected' : '' }}>
                {{ $bloque['start'] }} - {{ $bloque['end'] }}
            </option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <label for="periodo_academico_id">Período Académico</label>
    <select name="periodo_academico_id" id="periodo_academico_id" class="form-control" required>
        <option value="">Seleccione un período</option>
        @foreach ($periodos as $periodo)
            <option value="{{ $periodo->id }}"
                {{ old('periodo_academico_id', isset($horario) ? $horario->periodo_academico_id : '') == $periodo->id ? 'selected' : '' }}>
                {{ $periodo->periodo }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="unidad_curricular_id">Unidad Curricular</label>
    <select name="unidad_curricular_id" id="unidad_curricular_id" class="form-control" required>
        <option value="">Seleccione una unidad</option>
        @isset($horario)
            @foreach ($unidades as $unidad)
                <option value="{{ $unidad['id'] }}"
                    {{ old('unidad_curricular_id', isset($horario) ? $horario->unidad_curricular_id : '') == $unidad['id'] ? 'selected' : '' }}>
                    {{ $unidad['nombre'] }}
                </option>
            @endforeach
        @endisset

    </select>
</div>

<div class="form-group">
    <label for="seccion_id">Sección</label>
    <select name="seccion_id" id="seccion_id" class="form-control" required>
        @if (isset($secciones))
            @foreach ($secciones as $seccion)
                <option value="{{ $seccion->id }}"
                    {{ old('seccion_id', isset($horario) ? $horario->seccion_id : '') == $seccion->id ? 'selected' : '' }}>
                    {{ $seccion->nombre }}
                </option>
            @endforeach
        @else
            <option value="">Seleccione una unidad curricular primero</option>
        @endif
    </select>
</div>


<div class="form-group">
    <label for="sede">Sede</label>
    <select name="sede" id="sede" class="form-control" required>
        <option value="">Seleccione una sede</option>
        @foreach ($sedes as $sede)
            <option value="{{ $sede }}"
                {{ old('sede', isset($horario) ? $horario->sede : '') == $sede ? 'selected' : '' }}>
                {{ $sede }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="aula_id">Aula</label>
    <select name="aula_id" id="aula_id" class="form-control" required>
        <option value="">Seleccione una aula</option>
        {{-- Las opciones se llenarán dinámicamente con JS --}}

        @isset($horario)
            @foreach ($aulas as $aula)
                <option value="{{ $aula->id }}"
                    {{ old('aula_id', isset($horario) ? $horario->aula_id : '') == $aula->id ? 'selected' : '' }}>
                    {{ $aula->descripcion }}
                </option>
            @endforeach
        @endisset

    </select>
</div>


<div class="form-group">
    <label>Módulos</label>
    <select name="modulo" class="form-control">
        <option value="">Seleccione un módulo</option>
        @foreach ($modulos as $modulo)
            <option value="{{ $modulo }}"
                {{ old('modulo', isset($horario) ? $horario->modulo : '') == $modulo ? 'selected' : '' }}>
                {{ $modulo }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Pisos</label>
    <select name="piso" class="form-control">
        <option value="">Seleccione un piso</option>
        @foreach ($pisos as $piso)
            <option value="{{ $piso }}"
                {{ old('piso', isset($horario) ? $horario->piso : '') == $piso ? 'selected' : '' }}>
                {{ $piso }}
            </option>
        @endforeach
    </select>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Recupera los valores antiguos de Laravel (old)
        const oldUnidad =
            "{{ old('unidad_curricular_id', isset($horario) ? $horario->unidad_curricular_id : '') }}";
        const oldSeccion = "{{ old('seccion_id', isset($horario) ? $horario->seccion_id : '') }}";
        const oldAula = "{{ old('aula_id', isset($horario) ? $horario->aula_id : '') }}";
        const oldPeriodo =
            "{{ old('periodo_academico_id', isset($horario) ? $horario->periodo_academico_id : '') }}";
        const oldSede = "{{ old('sede', isset($horario) ? $horario->sede : '') }}";

        // Si hay old para periodo, dispara el change para cargar unidades curriculares y selecciona la opción correcta
        if (oldPeriodo) {
            const periodoSelect = document.getElementById('periodo_academico_id');
            periodoSelect.value = oldPeriodo;
            periodoSelect.dispatchEvent(new Event('change'));

            // Espera a que se carguen las unidades curriculares por AJAX
            setTimeout(function() {
                if (oldUnidad) {
                    const unidadSelect = document.getElementById('unidad_curricular_id');
                    unidadSelect.value = oldUnidad;
                    unidadSelect.dispatchEvent(new Event('change'));
                }
            }, 500);
        }

        // Espera a que se carguen las secciones por AJAX
        setTimeout(function() {
            if (oldSeccion) {
                const seccionSelect = document.getElementById('seccion_id');
                seccionSelect.value = oldSeccion;
            }
        }, 1000);

        // Si hay old para sede, dispara el change para cargar aulas y selecciona la opción correcta
        if (oldSede) {
            const sedeSelect = document.getElementById('sede');
            sedeSelect.value = oldSede;
            sedeSelect.dispatchEvent(new Event('change'));

            setTimeout(function() {
                if (oldAula) {
                    const aulaSelect = document.getElementById('aula_id');
                    aulaSelect.value = oldAula;
                }
            }, 500);
        }
    });
</script>


{{-- ELEMENTOS PARA MANIPULAR LOS BLOQUES DE HORA --}}
<script>
    function parseTime(str) {
        // Convierte "7:50 AM" a minutos desde 00:00
        const [time, modifier] = str.split(' ');
        if (!time || !modifier) return null;
        let [hours, minutes] = time.split(':').map(Number);
        if (modifier === 'PM' && hours !== 12) hours += 12;
        if (modifier === 'AM' && hours === 12) hours = 0;
        return hours * 60 + minutes;
    }

    // Obtén los bloques del backend en el mismo orden que el select
    const bloques = @json($bloques);

    function getBloqueIndexByStart(start) {
        return bloques.findIndex(b => b.start === start);
    }

    function getBloqueIndexByEnd(end) {
        return bloques.findIndex(b => b.end === end);
    }

    document.getElementById('hora_inicio').addEventListener('change', function() {
        const inicio = this.value;
        const fin = document.getElementById('hora_finalizacion').value;
        const idxInicio = getBloqueIndexByStart(inicio);
        const idxFin = getBloqueIndexByEnd(fin);

        if (inicio && fin) {
            // No permitir mismo bloque
            if (idxInicio !== -1 && idxFin !== -1 && idxInicio === idxFin) {
                callSwalAlert('No puede seleccionar el mismo bloque para inicio y fin.');
                this.value = '';
                return;
            }
            // Validar orden y máximo 3 bloques
            if (idxInicio !== -1 && idxFin !== -1) {
                if (idxInicio > idxFin) {
                    callSwalAlert('La hora de inicio debe ser menor que la hora de finalización.');
                    this.value = '';
                    return;
                }
                if ((idxFin - idxInicio) > 2) {
                    callSwalAlert('No puede asignar más de 3 bloques de hora.');
                    this.value = '';
                    return;
                }
            }
        }
    });

    document.getElementById('hora_finalizacion').addEventListener('change', function() {
        const fin = this.value;
        const inicio = document.getElementById('hora_inicio').value;
        const idxInicio = getBloqueIndexByStart(inicio);
        const idxFin = getBloqueIndexByEnd(fin);

        if (inicio && fin) {
            // No permitir mismo bloque
            if (idxInicio !== -1 && idxFin !== -1 && idxInicio === idxFin) {
                callSwalAlert('No puede seleccionar el mismo bloque para inicio y fin.');
                this.value = '';
                return;
            }
            // Validar orden y máximo 3 bloques
            if (idxInicio !== -1 && idxFin !== -1) {
                if (idxFin < idxInicio) {
                    callSwalAlert('La hora de finalización debe ser mayor que la hora de inicio.');
                    this.value = '';
                    return;
                }
                if ((idxFin - idxInicio) > 2) {
                    callSwalAlert('No puede asignar más de 3 bloques de hora.');
                    this.value = '';
                    return;
                }
            }
        }
    });
</script>

<script>
    document.getElementById('periodo_academico_id').addEventListener('change', function() {
        const periodo = this.value;
        const select = document.getElementById('unidad_curricular_id');
        select.innerHTML = '<option value="">Cargando unidades curriculares...</option>';

        if (!periodo) {
            periodo.innerHTML = '<option value="">Seleccione un período primero</option>';
            return;
        }
        fetch(`/admin/horario/unidadesCurriculares/${encodeURIComponent(periodo)}`)
            .then(response => response.json())
            .then(data => {
                select.innerHTML = '<option value="">Seleccione una unidad curricular</option>';
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.nombre;
                    select.appendChild(option);
                });
            })
            .catch(() => {
                select.innerHTML = '<option value="">Error al cargar unidades curriculares</option>';
            });
    });


    document.getElementById('sede').addEventListener('change', function() {
        const sede = this.value;
        const aulaSelect = document.getElementById('aula_id');
        aulaSelect.innerHTML = '<option value="">Cargando aulas...</option>';

        if (!sede) {
            aulaSelect.innerHTML = '<option value="">Seleccione una sede primero</option>';
            return;
        }
        fetch(`/admin/horario/aulas/${encodeURIComponent(sede)}`)
            .then(response => response.json())
            .then(data => {
                aulaSelect.innerHTML = '<option value="">Seleccione una aula</option>';
                data.forEach(aula => {
                    const option = document.createElement('option');
                    option.value = aula.id;
                    option.text = aula.descripcion;
                    aulaSelect.appendChild(option);
                });
            })
            .catch(() => {
                aulaSelect.innerHTML = '<option value="">Error al cargar aulas</option>';
            });
    });

    function callSwalAlert(body) {
        window.dispatchEvent(new CustomEvent('success', {
            detail: [{
                title: "Mensaje de error",
                message: body,
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
