<x-admin>
    @section('title', 'Crear Lineamiento Docente')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.lineamiento_docente.create') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Docente</label>
                    <select name="docente_id" class="form-control" required>
                        @foreach ($docentes as $docente)
                            <option value="{{ $docente->id }}" @if(old('docente_id') == $docente->id) selected @endif>{{ $docente->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Fecha Supervisión</label>
                    <input type="date" name="fecha_supervision" class="form-control" value="{{ old('fecha_supervision') }}" required>
                </div>

                <div class="form-group">
                    <label>Resumen</label>
                    <input type="text" name="resumen" class="form-control" value="{{ old('resumen') }}" required>
                </div>

                <div class="form-group">
                    <label>Cumple Lineamientos</label>
                    <input type="text" name="cumple_lineamientos" class="form-control" value="{{ old('cumple_lineamientos') }}" required>
                </div>

                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Periodo Académico</label>
                    <select name="periodo_academico_id" class="form-control" required>
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}" @if(old('periodo_academico_id') == $periodo->id) selected @endif>{{ $periodo->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Crear Lineamiento</button>
            </form>
        </div>
    </div>
</x-admin>
