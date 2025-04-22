<x-admin>
    @section('title','Horarios')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Horarios</h3>
            <div class="card-tools">
                <a href="{{ route('admin.admin.horarios.pdf') }}" class="btn btn-sm btn-danger">Generar PDF</a>
                <a href="{{ route('admin.horario.create') }}" class="btn btn-sm btn-info">Nuevo</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <table class="table table-striped" id="horarioTable">
                <thead>
                    <tr>
                        <th>Docente</th>
                        <th>Unidad Curricular</th>
                        <th>Sección</th>
                        <th>Día</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($horarios as $horario)
                        <tr>
                            <td>{{ $horario->docente->nombre }}</td>
                            <td>{{ $horario->unidadCurricular->nombre }}</td>
                            <td>{{ $horario->seccion }}</td>
                            <td>{{ \Carbon\Carbon::parse($horario->dia)->format('d/m/Y') }}</td>
                            <td>{{ $horario->hora_inicio }}</td>
                            <td>{{ $horario->hora_finalizacion }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('admin.horario.show', $horario->id) }}" class="btn btn-sm btn-secondary">Ver</a>
                                <a href="{{ route('admin.horario.edit', $horario->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('admin.horario.destroy', $horario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este horario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('js')
        <script>
            $(function() {
                $('#horarioTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
