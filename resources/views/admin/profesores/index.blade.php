<x-admin>
    @section('title','Listado de Profesores')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Profesores</h3>
            <div class="card-tools">
                <a href="{{ route('admin.profesores.export') }}" class="btn btn-sm btn-success">Exportar Excel</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="docentesTable">
                <thead>
                    <tr>
                        <th>SEDE</th>
                        <th>DOCENTE</th>
                        <th>CÉDULA</th>
                        <th>CORREO</th>
                        <th>CARRERA</th>
                        <th>UNIDAD CURRICULAR</th>
                        <th>N° DE SECCIONES</th>
                        <th>MODALIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profesores as $profesor)
                        <tr>
                            <td>{{ $profesor->sede }}</td>
                            <td>{{ $profesor->docente}}</td>
                            <td>{{ $profesor->cedula }}</td>
                            <td>{{ $profesor->correo }}</td>
                            <td>{{ $profesor->carrera }}</td>
                            <td>{{ $profesor->unidad_curricular }}</td>
                            <td>{{ $profesor->num_secciones }}</td>
                            <td>{{ $profesor->modalidad }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('js')
        <script>
            $(function() {
                $('#docentesTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    responsive: true,
                });
            });
        </script>
    @endsection
</x-admin>