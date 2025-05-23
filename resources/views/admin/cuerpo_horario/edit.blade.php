<x-admin>
    @section('title', 'Editar Encabezado de Horario')

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
            <form action="{{ route('admin.cuerpo_horario.update', $cuerpo_horario ? $cuerpo_horario->id : 0) }}"
                method="POST">
                @csrf
                @method('PUT')
                <img src="{{ asset('admin/dist/img/UnegLogo_160x160.jpg') }}" alt="Logo UNEG"
                    style="max-width: 160px; max-height: 160px; display: block; margin: 0 auto;">
                <br>
                    <textarea class="textarea" name="descripcion">{{ old('descripcion', $cuerpo_horario->descripcion ?? '') }}</textarea>

                <button type="submit" class="btn btn-primary mt-3">Guardar Contenido de horario</button>
            </form>
        </div>
    </div>


    <script></script>



</x-admin>
