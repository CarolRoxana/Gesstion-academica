<x-admin>
    @section('title', 'Evaluaciones de ' . ($docente->nombre ?? 'Docente'))

    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Unidad Curricular</th>
                        <th>Tipo</th>
                        <th>Porcentaje</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evaluaciones as $eval)
                        <tr>
                            <td>{{ $eval->unidadCurricularPeriodoAcademico->unidadCurricular->nombre }}</td>
                            <td>{{ $eval->tipo_evaluacion }}</td>
                            <td>{{ $eval->porcentaje_evaluacion }}%</td>
                            <td>{{ \Carbon\Carbon::parse($eval->fecha_evaluacion)->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
