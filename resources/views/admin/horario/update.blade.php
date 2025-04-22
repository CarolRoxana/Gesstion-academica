<x-admin>
    @section('title', 'Editar Horario')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar Horario</h3>
            <a href="{{ route('admin.horario.index') }}" class="btn btn-sm btn-secondary float-right">Volver</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.horario.update', $horario) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Repite los inputs como en create, pero con valores por defecto: -->
                <div class="form-group">
                    <label for="docente_id">Docente</label>
                    <select name="docente_id" class="form-control" required>
                        @foreach($docentes as $d)
                            <option value="{{ $d->id }}" @selected($horario->docente_id == $d->id)>
                                {{ $d->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Repetir para unidad curricular, periodo, día, hora_inicio, hora_finalización, sección -->

                <button type="submit" class="btn btn-primary">Actualizar Horario</button>
            </form>
        </div>
    </div>
</x-admin>
@section('js')
    <script>
        $(function() {
            $('#horarioTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
            });
        });
    </script>