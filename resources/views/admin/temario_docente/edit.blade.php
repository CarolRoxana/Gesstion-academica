<x-admin>
    @section('title', 'Editar Temario Docente')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.temario_docente.update', $temario->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Unidad Curricular y Período Académico</label>
                    <select name="unidad_curricular_periodo_academico_id" class="form-control" required>
                        @foreach($unidadCurricularPeriodoAcademico as $uc)
                            <option value="{{ $uc->id }}" {{ $uc->id == $temario->unidad_curricular_periodo_academico_id ? 'selected' : '' }}>
                                {{ $uc->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Contenido (Archivo PDF)</label>
                    <input type="file" name="contenido" class="form-control" accept="application/pdf">
                    @if($temario->contenido)
                        <a href="{{ asset('storage/' . $temario->contenido) }}" target="_blank" class="btn btn-info mt-2">Ver PDF Actual</a>
                    @endif
                </div>
                <div class="form-group">
                    <label>Fecha de Agregado</label>
                    <input type="datetime-local" name="fecha_agregado" class="form-control" value="{{ $temario->fecha_agregado->format('Y-m-d\TH:i') }}" required>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
</x-admin>
