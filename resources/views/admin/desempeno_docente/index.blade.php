<x-admin>
@section('title', 'Desempeño Docentes')

<div class="card shadow-sm">
    <div class="card-header ">
        <a href="{{ route('admin.desempeno-docente.create') }}" class="btn btn-sm btn-primary ">
        <i class="fas fa-plus-circle me-1"></i> Nuevo Desempeño
        </a>
    </div>
    
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <select name="docente_id" class="form-select">
                            <option value="">Todos los docentes</option>
                            @foreach ($docentes as $docente)
                                <option value="{{ $docente->id }}" {{ request('docente_id') == $docente->id ? 'selected' : '' }}>
                                    {{ $docente->nombre }} {{ $docente->apellido }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-secondary" type="submit">Filtrar</button>
                    </div>
                </div>
            </div>
        </form>
        
        <div class="table-responsive">
            <table class="table table-bordered " id="desempenosTable" style="width:100%">
                <thead>
                    <tr>
                        <th>Docente</th>
                        <th>Unidad Curricular</th>
                        <th>Puntualidad 100%</th>
                        <th>Calidad de Enseñanza</th>
                        <th>Participación en Proyectos</th>
                        <th>Cumplimiento Administrativo</th>
                        <th>Fecha de Evaluación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($desempenos as $desempeno)
                    <tr>
                        <td class="fw-bold">{{ $desempeno->docente->nombre }} {{ $desempeno->docente->apellido }}</td>
                        <td>{{ $desempeno->unidadCurricularPeriodoAcademico->unidadCurricular->nombre }}</td>
                        <td>{{ $desempeno->puntualidad }}</td>
                        <td>{{ $desempeno->calidad_ensenanza }}</td>
                        <td>{{ $desempeno->participacion_proyectos }}</td>
                        <td>{{ $desempeno->cumplimiento_administrativo }}</td>
                        <td>{{ \Carbon\Carbon::parse($desempeno->fecha_evaluacion)->format('d/m/Y') }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.desempeno-docente.show', $desempeno->id) }}" class="btn btn-sm btn-success">Ver</a>
                            <a href="{{ route('admin.desempeno-docente.edit', $desempeno->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.desempeno-docente.destroy', $desempeno->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            {{ $desempenos->links() }}
        </div>
    </div>
</div>

@section('js')
    <script>
        $(function () {
            $('#desempenosTable').DataTable({
                paging: false,
                searching: true,
                ordering: true,
                responsive: true,
                scrollX: false,
            });
            
            $('.dataTables_filter input').addClass('form-control-sm');
        });
        });
    </script>
@endsection
</x-admin>