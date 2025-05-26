{{-- filepath: resources/views/admin/temario_docente/index.blade.php --}}
<x-admin>
    @section('title', 'Temarios Docente')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.temario_docente.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Agregar Temario
            </a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Docente</th>
                        <th>Unidad Curricular</th>
                        <th>Contenido (PDF)</th>
                        <th>Fecha Agregado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($temarios as $temario)
                        <tr>
                            <td>
                                {{ $temario->docente ? ($temario->docente->apellido . ', ' . $temario->docente->nombre) : '-' }}
                            </td>
                            <td>
                                {{ $temario->unidadCurricularPeriodoAcademico && $temario->unidadCurricularPeriodoAcademico->unidadCurricular
                                    ? $temario->unidadCurricularPeriodoAcademico->unidadCurricular->nombre
                                    : '-' }}
                            </td>
                            <td>
                                @if($temario->contenido)
                                    <a href="{{ asset('storage/' . $temario->contenido) }}" target="_blank" class="btn btn-info btn-sm">Ver PDF</a>
                                @else
                                    <span class="text-muted">No disponible</span>
                                @endif
                            </td>
                            <td>{{ $temario->fecha_agregado }}</td>
                            <td>
                                <a href="{{ route('admin.temario_docente.edit', $temario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('admin.temario_docente.destroy', $temario->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este temario?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>