@auth
<div class="row">
    <x-guest-layout>
        @section('title', 'Gestión Académica UNEG')
    
        <div class="text-center mt-5">
            <!-- Ícono de la UNEG -->
            <img src="{{ asset('admin/dist/img/UnegLogo.jpg') }}" alt="Uneg-Logo" style="max-width: 150px;" class="mb-4">
    
            <!-- Texto sobre la gestión académica -->
            <h1 class="h3 mb-3 font-weight-bold">Gestión Académica de la UNEG</h1>
            <p class="lead">
                Bienvenido al sistema de gestión académica de la Universidad Nacional Experimental de Guayana (UNEG). 
                Este sistema está diseñado para facilitar la administración de procesos académicos, 
                incluyendo la gestión de docentes, estudiantes, unidades curriculares y más.
            </p>
            
        </div>
    </x-guest-layout>


       
    </div>
@endauth
