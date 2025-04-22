<x-admin>
    @section('title', 'Registrar Incidente Estudiantil')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.incidente-estudiantil.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="docente_id" class="form-label">Docente</label>
                    <select name="docente_id" class="form-control">
                        @foreach ($docentes as $docente)
                            <option value="{{ $docente->id }}" {{ old('docente_id', $incidente->docente_id ?? '') == $docente->id ? 'selected' : '' }}>
                                {{ $docente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                @foreach (['nombre', 'apellido', 'cedula', 'carrera', 'semestre', 'incidente'] as $field)
                    <div class="mb-3">
                        <label for="{{ $field }}" class="form-label">{{ ucfirst($field) }}</label>
                        <input type="text" name="{{ $field }}" class="form-control" value="{{ old($field, $incidente->$field ?? '') }}">
                    </div>
                @endforeach
                
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion', $incidente->descripcion ?? '') }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="fecha_incidente" class="form-label">Fecha del Incidente</label>
                    <input type="datetime-local" name="fecha_incidente" class="form-control" value="{{ old('fecha_incidente', isset($incidente) ? \Carbon\Carbon::parse($incidente->fecha_incidente)->format('Y-m-d\TH:i') : '') }}">
                </div>
                
                <button type="submit" class="btn btn-primary mt-3">Guardar</button>
            </form>
        </div>
    </div>
</x-admin>
