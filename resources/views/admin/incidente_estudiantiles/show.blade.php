<x-admin>
    @section('title', 'Detalle del Incidente')

    <div class="card">
        <div class="card-body">
            <p><strong>Docente:</strong> {{ $incidente_estudiantil->docente->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $incidente_estudiantil->docente->apellido }}</p>
            <p><strong>Estudiante:</strong> {{ $incidente_estudiantil->nombre }} {{ $incidente_estudiantil->apellido }}</p>
            <p><strong>Cédula:</strong> {{ $incidente_estudiantil->cedula }}</p>
            <p><strong>Carrera:</strong> {{ $incidente_estudiantil->carrera }}</p>
            <p><strong>Semestre:</strong> {{ $incidente_estudiantil->semestre }}</p>
            <p><strong>Incidente:</strong> {{ $incidente_estudiantil->incidente }}</p>
            <p><strong>Descripción:</strong> {{ $incidente_estudiantil->descripcion }}</p>
            <p><strong>Fecha:</strong> {{ $incidente_estudiantil->fecha_incidente }}</p>

            <a href="{{ route('admin.incidente-estudiantil.index') }}" class="btn btn-secondary mt-3">Volver</a>
        </div>
    </div>
</x-admin>
