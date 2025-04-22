<x-admin>
    @section('title', 'Editar Asignación')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.unidad-curricular-periodo.update', $registro->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Unidad Curricular</label>
                    <select name="unidad_curricular_id" class="form-control" required>
                        @foreach($unidad_curricular as $uc)
                            <option value="{{ $uc->id }}" {{ $registro->unidad_curricular_id == $uc->id ? 'selected' : '' }}>
                                {{ $uc->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Periodo Académico</label>
                    <select name="periodo_academico_id" class="form-control" required>
                        @foreach($periodos as $periodo)
                            <option value="{{ $periodo->id }}" {{ $registro->periodo_academico_id == $periodo->id ? 'selected' : '' }}>
                                {{ $periodo->periodo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Docente</label>
                    <select name="docente_id" class="form-control" required>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}" {{ $registro->docente_id == $docente->id ? 'selected' : '' }}>
                                {{ $docente->nombre }} {{ $docente->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Sede</label>
                    <input type="text" name="sede" class="form-control" value="{{ $registro->sede }}" required>
                </div>

                <div class="form-group">
                    <label>Modalidad</label>
                    <input type="text" name="modalidad" class="form-control" value="{{ $registro->modalidad }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</x-admin>
