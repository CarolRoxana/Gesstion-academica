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


        {{-- <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $user }}</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin.user.index') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> --}}
        {{-- <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $category }}</h3>
                    <p>Total Categories</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-alt"></i>
                </div>
                <a href="{{ route('admin.category.index') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $product }}</h3>
                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <i class="fas fas fa-th"></i>
                </div>
                <a href="{{ route('admin.product.index') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $collection }}</h3>
                    <p>Total Collections</p>
                </div>
                <div class="icon">
                    <i class="fas fas fa-file-pdf"></i>
                </div>
                <a href="{{ route('admin.collection.index') }}" class="small-box-footer">View <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> --}}
    </div>
@endauth
