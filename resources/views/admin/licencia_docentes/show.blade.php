<x-admin>
    @section('title', 'Detalle de Licencia')

    <div class="card">
        <div class="card-body">
            <p><strong>Docente:</strong> {{ $licencia_docente->user->name }}</p>
            <p><strong>Nombre del Curso:</strong> {{ $licencia_docente->nombre_curso }}</p>
            <p><strong>Institución:</strong> {{ $licencia_docente->institucion }}</p>
            <p><strong>Tipo de Curso:</strong> {{ $licencia_docente->tipo_curso }}</p>
            <p><strong>Fecha de Inicio:</strong> {{ $licencia_docente->fecha_inicio }}</p>
            <p><strong>Fecha de Fin:</strong> {{ $licencia_docente->fecha_fin }}</p>
            <p><strong>Estatus:</strong> {{ $licencia_docente->estatus }}</p>

            <a href="{{ route('admin.licencia_docentes.index') }}" class="btn btn-secondary mt-3">Volver</a>
        </div>
    </div>
</x-admin>
