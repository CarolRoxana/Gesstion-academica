<x-admin>
    @section('title', 'Editar Temario Docente')
    <div class="card">
        <div class="card-body">
           <form action="{{ route('admin.temario_docente.update', $temario->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="docente_id" class="form-label">Docente</label>
                <select name="docente_id" class="form-control" required>
                    @foreach($docentes as $docente)
                        <option value="{{ $docente->id }}" {{ old('docente_id', $temario->docente_id ?? '') == $docente->id ? 'selected' : '' }}>
                            {{ $docente->apellido }}, {{ $docente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Unidad Curricular y Período Académico</label>
                <select name="unidad_curricular_periodo_academico_id" class="form-control" required>
                    @foreach($unidadCurricularPeriodoAcademico as $uc)
                        <option value="{{ $uc->id }}"
                            {{ old('unidad_curricular_periodo_academico_id', $temario->unidad_curricular_periodo_academico_id) == $uc->id ? 'selected' : '' }}>
                            {{ $uc->unidadCurricular->nombre }} - {{ $uc->modalidad }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Contenido (Archivo PDF)</label>
                <input type="file" name="contenido" class="form-control" accept="application/pdf">
                @if($temario->contenido)
                    <a href="{{ asset('storage/' . $temario->contenido) }}" target="_blank" class="btn btn-info mt-2">Ver PDF Actual</a>
                @endif
            </div>

            <div class="form-group mb-3">
                <label>Fecha de Agregado</label>
                <input 
                    type="date" 
                    name="fecha_agregado" 
                    class="form-control" 
                    value="{{ old('fecha_agregado', \Carbon\Carbon::parse($temario->fecha_agregado)->format('Y-m-d')) }}" 
                    required
                >
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>

        </div>
    </div>
</x-admin>
