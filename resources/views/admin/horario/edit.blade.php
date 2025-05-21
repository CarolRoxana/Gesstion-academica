
<x-admin>
    @section('title', 'Editar Horario')

    <div class="card">
        <div class="card-header">
          
            <div class="card-tools">
                <a href="{{ route('admin.horario.index') }}" class="btn btn-sm btn-secondary">Volver</a>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                                <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          <form action="{{ route('admin.horario.update', $horario->id) }}" method="POST">
                @csrf

                @method('PUT')
                @include('admin.horario.form', [
                    'action' => route('admin.horario.update', $horario->id),
                    'method' => 'PUT',
                    'docentes' => $docentes,
                    "unidades" => $unidades,
                    'secciones' => $secciones,
                    'periodos' => $periodos,
                    'horario' => $horario,
                    'btnText' => 'Actualizar Horario',
                    'showButton' => true,
                ])
                <button type="submit" class="btn btn-primary mt-3">Guardar Horario</button>
            </form>
        </div>
    </div>




</x-admin>
