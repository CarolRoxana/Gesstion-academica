<x-admin>
    @section('title', 'Detalle del Docente')
    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $docente->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $docente->apellido }}</p>
            <p><strong>Cédula:</strong> {{ $docente->cedula }}</p>
            <p><strong>Título:</strong> {{ $docente->titulo }}</p>
            <p><strong>Correo:</strong> {{ $docente->correo }}</p>
            <p><strong>Teléfono:</strong> {{ $docente->telefono }}</p>
            <a href="{{ route('admin.docente.edit', $docente->id) }}" class="btn btn-primary">Editar</a>
            <a href="{{ route('admin.docente.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</x-admin>