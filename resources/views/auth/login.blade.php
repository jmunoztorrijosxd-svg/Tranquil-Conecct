<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-white-100">
        <div class="flex bg-white shadow-lg rounded-lg overflow-hidden w-4/5 max-w-5xl">
            
            <img src="{{ asset('images/login_image.png') }}" alt="login image.png" class="h-auto w-1/2 object-contain mx-auto">

            <!-- Formulario a la derecha -->
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">Inicia Sesión</h2>

                <x-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <x-label for="email" value="{{ __('Correo Electrónico') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" 
                                 :value="old('email')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mb-4">
                        <x-label for="password" value="{{ __('Contraseña') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" 
                                 name="password" required autocomplete="current-password" />
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <label class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-gray-900" 
                               href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <x-button class="w-full mb-4">
                        {{ __('Iniciar Sesión') }}
                    </x-button>

                    <p class="text-center text-sm text-gray-600">
                        ¿No tienes cuenta? 
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Regístrate</a>
                    </p>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>
