<x-admin>
    @section('title', 'Detalle Unidad Curricular')

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $unidad_curricular->nombre }}</p>
            <p><strong>Unidad Curricular:</strong> {{ $unidad_curricular->unidad_curricular }}</p>
            <p><strong>Carrera:</strong> {{ $unidad_curricular->carrera }}</p>
            <p><strong>Semestre:</strong> {{ $unidad_curricular->semestre }}</p>
            
            <p><strong>Secciones:</strong></p>
            <ul>
                @forelse($unidad_curricular->secciones as $seccion)
                    <li>{{ $seccion->nombre }}</li>
                @empty
                    <li>No hay secciones registradas.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <a href="{{ route('admin.unidad-curricular.index') }}" class="btn btn-secondary mt-3">Volver</a>
</x-admin>
