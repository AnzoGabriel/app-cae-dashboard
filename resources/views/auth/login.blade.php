@extends('layout.app')

@section('title', 'Login')

@section('content')

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-20 w-auto" src="{{ asset('images/logo.svg') }}" alt="Logo IFTO Porto">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Acessar Dashboard
            </h2>
        </div>

        <div class="mt-10 mx-auto sm:w-full sm:max-w-sm w-80">
            <form class="space-y-6" action="{{ route('auth') }}" method="POST">
                @csrf
                @error('auth_error_expired')
                    <div class="alert alert-danger text-yellow-300 mt-1 bg-yellow-700 p-2 text-center font-bold">
                        {{ $message }}</div>
                @enderror
                @error('auth_error')
                    <div class="alert alert-danger text-red-600 mt-1 bg-red-200 p-2 text-center font-bold">{{ $message }}
                    </div>
                @enderror
                <div>
                    <label for="n_matricula" class="block text-sm font-medium leading-6 text-gray-900">Nº de
                        Matrícula</label>
                    <div class="mt-2">
                        <input id="n_matricula" name="n_matricula" type="number" autocomplete="on"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
                            value="{{ old('n_matricula') }}">

                        @error('n_matricula')
                            <div class="alert alert-danger text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- INPUT PASSWORD --}}
                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha</label>
                    <div class="mt-2 relative">
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6">

                        <!-- Botão para ver/ocultar senha -->
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-600 hover:text-gray-800 focus:outline-none">
                            <!-- Ícone -->
                            <i class="bi bi-eye"></i>
                        </button>
                        @error('password')
                            <div class="alert alert-danger text-red-600 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>


                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-green-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">Entrar</button>
                </div>
            </form>
        </div>
    </div>



@endsection

@push('scripts')
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const inputPassword = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            // Alterna o tipo de input entre 'password' e 'text'
            const type = inputPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            inputPassword.setAttribute('type', type);

            // Alterna o ícone entre 'eye' e 'eye-slash'
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    </script>
@endpush
