<x-admin>
@section('title', 'Lineamientos Docentes')

<div class="card shadow-sm">
    <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
        <a href="{{ route('admin.lineamiento-docente.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Crear Lineamiento
        </a>
    </div>
    
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="lineamientosTable" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>Docente</th>
                        <th>Fecha Supervisión</th>
                        <th>Resumen</th>
                        <th>Cumple Lineamientos</th>
                        <th>Periodo Académico</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lineamientos as $lineamiento)
                        <tr>
                            <td class="fw-bold">{{ $lineamiento->docente->nombre }} {{ $lineamiento->docente->apellido }}</td>
                            <td>{{ \Carbon\Carbon::parse($lineamiento->fecha_supervision)->format('d/m/Y') }}</td>
                            <td>
                                {{ \Illuminate\Support\Str::limit($lineamiento->resumen, 100) }}
                            </td>
                            <td class="text-center">
                                @if($lineamiento->cumple_lineamientos === 'Sí' || $lineamiento->cumple_lineamientos === 'Si')
                                    <span class="badge bg-success">Sí</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>{{ $lineamiento->periodoAcademico->periodo }}</td>
                            <td class="text-nowrap text-center">
                                <a href="{{ route('admin.lineamiento-docente.show', $lineamiento->id) }}" class="btn btn-sm btn-info">
                                 Ver
                                </a>
                                <a href="{{ route('admin.lineamiento-docente.edit', $lineamiento->id) }}" class="btn btn-sm btn-warning">
                                     Editar
                                </a>
                                <form action="{{ route('admin.lineamiento-docente.destroy', $lineamiento->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro que desea eliminar este lineamiento?')">
                                         Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('js')
    <script>
        $(function () {
            $('#lineamientosTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
                scrollX: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                    search: "Docente:",
                    searchPlaceholder: "Buscar por nombre...",
                },
                dom: '<"top mb-3 w-100 d-flex justify-content-end"f>rt<"bottom"p><"clear">',
                columnDefs: [
                    { orderable: false, targets: 5 }
                ]
            });
            
            $('.dataTables_filter input').addClass('form-control-sm');
        });
    </script>
@endsection
</x-admin>