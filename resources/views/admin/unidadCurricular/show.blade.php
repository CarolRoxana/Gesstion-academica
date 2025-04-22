<x-admin>
    @section('title', 'Detalle Unidad Curricular')

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $unidad_curricular->nombre }}</p>
            <p><strong>Unidad Curricular:</strong> {{ $unidad_curricular->unidad_curricular }}</p>
            <p><strong>Carrera:</strong> {{ $unidad_curricular->carrera }}</p>
            <p><strong>Semestre:</strong> {{ $unidad_curricular->semestre }}</p>
            <p><strong>Docente:</strong> {{ $unidad_curricular->docente->nombre }} {{ $unidad_curricular->docente->apellido ?? '' }}</p>
        </div>
    </div>

    <a href="{{ route('admin.unidad-curricular.index') }}" class="btn btn-secondary mt-3">Volver</a>
</x-admin>
