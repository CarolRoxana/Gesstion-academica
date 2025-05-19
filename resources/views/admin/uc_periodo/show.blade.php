<x-admin>
    @section('title', 'Detalle de Asignación')

    <div class="card">
        <div class="card-body">
            <p><strong>Unidad Curricular:</strong> {{ $registro->unidadCurricular->nombre }}</p>
            <p><strong>Periodo Académico:</strong> {{ $registro->periodoAcademico->periodo }}</p>
            {{-- <p><strong>Docente:</strong> {{ $registro->docente->nombre }} {{ $registro->docente->apellido }}</p> --}}
            <p><strong>Sede:</strong> {{ $registro->sede }}</p>
            <p><strong>Modalidad:</strong> {{ $registro->modalidad }}</p>
            <p><strong>Módulo:</strong> {{ $registro->modulo }}</p>
            <p><strong>Pisos:</strong> {{ $registro->piso }}</p>

            <a href="{{ route('admin.unidad-curricular-periodo.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</x-admin>
