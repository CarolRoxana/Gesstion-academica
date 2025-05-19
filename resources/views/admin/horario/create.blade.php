<x-admin>
    @section('title', 'Registrar Horario')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Nuevo Horario</h3>
            <div class="card-tools">
                <a href="{{ route('admin.horario.index') }}" class="btn btn-sm btn-secondary">Volver</a>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.horario.store') }}" method="POST">
                @csrf
                @include('admin.horario.form', [
                    'action' => route('admin.horario.store'),
                    'docentes' => $docentes,
                    'unidades' => $unidades,
                    'secciones' => [],
                    'periodos' => $periodos,
                    'btnText' => 'Guardar Horario',
                    'showButton' => false,
                ])
                <button type="submit" class="btn btn-primary mt-3">Guardar Horario</button>
            </form>
        </div>
    </div>


</x-admin>
