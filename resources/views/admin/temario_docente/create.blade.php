<x-admin>
    @section('title', 'Agregar Temario Docente')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.temario_docente.store') }}" enctype="multipart/form-data">
                @csrf
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
                <div class="form-group">
                    <label>Unidad Curricular y Período Académico</label>
                    <select name="unidad_curricular_periodo_academico_id" class="form-control" required>
                        <option value="">Seleccione una unidad curricular</option>
                       @foreach($unidadCurricularPeriodoAcademico as $uc)
                            <option value="{{ $uc->id }}">
                                {{ $uc->unidadCurricular->nombre }} - {{ $uc->modalidad }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Contenido (Archivo PDF)</label>
                    <input type="file" name="contenido" class="form-control" required accept="application/pdf">
                </div>
              <div class="form-group">
                    <label>Fecha de Agregado</label>
                    <input 
                        type="date" 
                        name="fecha_agregado" 
                        class="form-control" 
                        value="{{ old('fecha_agregado', \Carbon\Carbon::now()->format('Y-m-d')) }}" 
                        required
                    >
                </div>
                <button type="submit" class="btn btn-success">Agregar</button>
            </form>
        </div>
    </div>
</x-admin>
