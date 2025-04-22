<x-admin>
    @section('title', 'Agregar Temario Docente')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.temario_docente.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Unidad Curricular y Período Académico</label>
                    <select name="unidad_curricular_periodo_academico_id" class="form-control" required>
                        @foreach($unidadCurricularPeriodoAcademico as $uc)
                            <option value="{{ $uc->id }}">{{ $uc->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Contenido (Archivo PDF)</label>
                    <input type="file" name="contenido" class="form-control" required accept="application/pdf">
                </div>
                <div class="form-group">
                    <label>Fecha de Agregado</label>
                    <input type="datetime-local" name="fecha_agregado" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Agregar</button>
            </form>
        </div>
    </div>
</x-admin>
