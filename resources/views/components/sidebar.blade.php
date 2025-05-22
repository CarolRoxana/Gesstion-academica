<nav class="mt-2">




    {{--    @hasanyrole(['Admin', 'Coordinador'])
        @include('components.sidebar-admin-coordinador')
    @endhasanyrole --}}

    {{--  @hasanyrole(['Jefe departamento'])
        @include('components.sidebar-jefe-apartamento')
    @endhasanyrole

    @hasanyrole(['Jefe area'])
        @include('components.sidebar-jefe-area')
    @endhasanyrole

    @hasanyrole(['Secretaria'])
        @include('components.sidebar-secretaria')
    @endhasanyrole
 --}}

    @hasanyrole(['Docente'])
        @include('components.sidebar-docente')
    @endhasanyrole



</nav>
