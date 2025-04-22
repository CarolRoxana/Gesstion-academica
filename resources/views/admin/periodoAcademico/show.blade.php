<x-admin>
    @section('title', 'Detalle del Periodo Académico')

    <div class="card">
        <div class="card-body">
            <h4><strong>Periodo:</strong> {{ $periodo_academico->periodo }}</h4>
            <p><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($periodo_academico->fecha_inicio)->format('d-m-Y') }}</p>
            <p><strong>Fecha de Finalización:</strong> {{ \Carbon\Carbon::parse($periodo_academico->fecha_finalizacion)->format('d-m-Y') }}</p>

            <a href="{{ route('admin.periodo-academico.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</x-admin>
