<x-guest-layout>
    @section('title')
        {{ 'Iniciar sessión' }}
    @endsection
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class=" text-center">
                <img src="{{ asset('admin/dist/img/UnegLogo.jpg') }}" alt="Uneg-Logo" class="mt-3" style="max-width: 100px;">
            </div>
            <div class="card-header text-center">
                <a href="/" class="h1"><b>{{ config('app.name') }}</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Iniciar sessión</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <label for="">Correo electrónico</label>
                    <div class="input-group mb-3">
                        <input id="email" class="form-control" type="email" name="email" :value="old('email') plaseholder="Correo electrónico"
                            required autofocus autocomplete="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <label for="">Contraseña</label>
                    <div class="input-group mb-3">
                        <input id="password" class="form-control" type="password" name="password" required placeholder="**********"
                            autocomplete="current-password">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword" tabindex="-1">
                                <span id="iconoPassword" class="fas fa-lock"></span>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    Recuerdame
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-6 mx-auto">
                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1 text-center">
                    <a href="{{ route('password.request') }}">Recuperar contraseña</a>
                </p>
                {{-- <p class="mb-0 text-center">
                    <a href="{{ route('register') }}" class="text-center">Registrar una nueva cuenta</a>
                </p> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('iconoPassword');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-lock');
                icon.classList.add('fa-lock-open');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-lock-open');
                icon.classList.add('fa-lock');
            }
    });
</script>
</x-guest-layout>
