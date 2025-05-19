<x-admin>
    @section('title','Nuevo Servicio Comunitario')
    @section('content_header')
        <h1>Registrar Servicio Comunitario</h1>
    @endsection

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.servicio_comunitario.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.servicio_comunitario.partials.form')
            </form>
        </div>
    </div>
</x-admin>
