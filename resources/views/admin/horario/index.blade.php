<x-admin>
    @section('title', 'Horarios')
    @include('admin.horario.modal_periodos', ['periodos' => $periodos])

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Horarios</h3>
            <div class="card-tools">

                <a href="#" id="btnGenerarPDF" class="btn btn-sm btn-danger" data-toggle="modal"
                    data-target="#modalFiltros">
                    Generar PDF
                </a>

                @can('crear_horarios')
                    <a href="{{ route('admin.horario.create', ) }}" class="btn btn-sm btn-info">Nuevo Horario</a>
                @endcan
                @canany(['ver_cuerpo_horario', 'crear_cuerpo_horario'])
                    <a href="{{ route('admin.cuerpo_horario.edit', $cuerpo_horario ? $cuerpo_horario->id : 0) }}"
                        class="btn btn-sm btn-info">Contenido de horario</a>
                @endcanany
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
                        <th>Periodo</th>
                        <th>Sección</th>
                        <th>Día</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Sede</th>
                        <th>Aula</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($horarios as $horario)
                        <tr>
                            <td>{{ $horario->docente->nombre }} {{ $horario->docente->apellido }}</td>
                            <td>{{ $horario->unidadCurricular->nombre }}</td>
                            <td>{{ $horario->periodoAcademico->periodo }}</td>
                            <td>{{ $horario->seccion->nombre }}</td>
                            <td>{{ $horario->dia }}</td>
                            <td>{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($horario->hora_finalizacion)->format('H:i') }}</td>
                            <td>
                                {{ $horario->sede }}
                            </td>
                            <td>
                                @if ($horario->sede === 'Atlantico')
                                    {{ \App\Helpers\ArrayHelper::descripcionAulaAtlanticoPorId($horario->aula_id) }}
                                @elseif($horario->sede === 'Villa Asia')
                                    {{ \App\Helpers\ArrayHelper::descripcionAulaVillasiaPorId($horario->aula_id) }}
                                @endif
                            </td>
                            <td class="d-flex gap-1">
                                @can('ver_horarios')
                                    <a href="{{ route('admin.horario.show', $horario->id) }}"
                                        class="btn btn-sm btn-secondary">Ver</a>
                                @endcan
                                @can('editar_horarios')
                                    <a href="{{ route('admin.horario.edit', $horario->id) }}"
                                        class="btn btn-sm btn-primary">Editar</a>
                                @endcan
                                @can('eliminar_horarios')
                                    <form action="{{ route('admin.horario.destroy', $horario->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este horario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('js')

        <script>
            function callSwalAlert(body) {
                window.dispatchEvent(new CustomEvent('success', {
                    detail: [{
                        title: "Mensaje de error",
                        message: body,
                    }]
                }));
            }
        </script>
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
        // Modal para filtros
        <script>
            document.getElementById('btnResetFiltros').addEventListener('click', function() {
                // Lógica para reiniciar filtros
                $('#modalFiltros').modal('hide');
            });

            document.getElementById('btnAplicarFiltros').addEventListener('click', function() {
                // Lógica para aplicar filtros
                //evalua que el select de periodo no este vacio y tenga un valor seleccionado

                const periodoSelect = document.getElementById('filtroPeriodo');
                $('#modalFiltros').modal('hide');
                if (periodoSelect.value === '') {
                    callSwalAlert('Por favor selecciona un período.');
                    return;
                }

                window.location.href = `/admin/horarios/pdf/${periodoSelect.value}`;




            });
        </script>

    @endsection
</x-admin>
