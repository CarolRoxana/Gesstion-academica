<x-admin>
    @section('title', 'Registrar Horario')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Nuevo Horario</h3>
            <div class="card-tools">
                <a href="{{ route('admin.horario.index') }}" class="btn btn-sm btn-secondary">Volver</a>
            </div>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.horario.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="docente_id">Docente</label>
                    <select name="docente_id" id="docente_id" class="form-control" required>
                        <option value="">Seleccione un docente</option>
                        @foreach ($docentes as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="dia">Día de la clase</label>
                    <input type="date" name="dia" id="dia" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="hora_inicio">Hora de inicio</label>
                    <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="hora_finalizacion">Hora de finalización</label>
                    <input type="time" name="hora_finalizacion" id="hora_finalizacion" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="unidad_curricular_id">Unidad Curricular</label>
                    <select name="unidad_curricular_id" id="unidad_curricular_id" class="form-control" required>
                        <option value="">Seleccione una unidad</option>
                        @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="seccion">Sección</label>
                    <input type="number" name="seccion" id="seccion" class="form-control" required min="1">
                </div>

                <div class="form-group">
                    <label for="periodo_academico_id">Período Académico</label>
                    <select name="periodo_academico_id" id="periodo_academico_id" class="form-control" required>
                        <option value="">Seleccione un período</option>
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <button class="btn btn-success">Guardar Horario</button>
                </div>
            </form>
        </div>
    </div>
</x-admin>
