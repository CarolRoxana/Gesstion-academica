<x-admin>
    @section('title', 'Nueva Unidad Curricular por Periodo')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.unidad-curricular-periodo.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Unidad Curricular</label>
                    <select name="unidad_curricular_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($unidad_curricular as $uc)
                            <option value="{{ $uc->id }}">{{ $uc->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Periodo Académico</label>
                    <select name="periodo_academico_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($periodos as $periodo)
                            <option value="{{ $periodo->id }}">{{ $periodo->periodo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Docente</label>
                    <select name="docente_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->nombre }} {{ $docente->apellido }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Sede</label>
                    <input type="text" name="sede" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Modalidad</label>
                    <input type="text" name="modalidad" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</x-admin>
