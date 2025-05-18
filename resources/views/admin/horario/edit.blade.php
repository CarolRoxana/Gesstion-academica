{{-- filepath: resources/views/admin/horario/edit.blade.php --}}
<x-admin>
    @section('title', 'Editar Horario')

    @include('admin.horario.form', [
        'action' => route('admin.horario.update', $horario->id),
        'method' => 'PUT',
        'docentes' => $docentes,
        'unidades' => $unidades,
        'secciones' => $secciones,
        'periodos' => $periodos,
        'horario' => $horario,
        'btnText' => 'Actualizar Horario',
        'showButton' => true
    ])

 
</x-admin>