<x-admin>
    @section('title', 'Docentes')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Docentes</h3>
           
        </div>
        <div class="card-body">
            <table class="table table-striped" id="docenteTable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docentes as $docente)
                        <tr>
                            <td>{{ $docente->nombre }}</td>
                            <td>{{ $docente->apellido }}</td>
                            <td>{{ $docente->cedula }}</td>
                            <td>{{ $docente->correo }}</td>
                            <td>{{ $docente->telefono }}</td>
                            <td>
                                <a href="{{ route('admin.docente_unit.show', $docente->id) }}"
                                    class="btn btn-sm btn-success">Ver</a>
                                <a href="{{ route('admin.docente_unit.edit', $docente->id) }}"
                                    class="btn btn-sm btn-primary">Editar</a>
                                {{-- CHEQUEA SI EL USUARIO TIENE EL PERMISO --}}
                             
                                 
                                
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
                $('#docenteTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    responsive: true,
                });
            });
        </script>
    @endsection
</x-admin>
