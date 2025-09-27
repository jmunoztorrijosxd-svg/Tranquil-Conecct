<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center">
        <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg overflow-hidden w-4/5 max-w-4xl">
            
            <div class="hidden md:flex w-1/2 items-center justify-center p-6">
                <img src="{{ asset('images/login_image.png') }}" alt="login image" class="h-full w-full object-contain">
            </div>

            <div class="w-full md:w-1/2 p-6 md:p-10">
                <x-authentication-card>
                    <x-slot name="logo">
                        {{-- Hemos ajustado el tamaño a h-16 para un mejor equilibrio visual --}}
                        <img src="{{ asset('images/tranquil_connect_new_logo.png') }}" alt="Mi logo" class="mx-auto h-5 w-auto">
                    </x-slot>

                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div>
                            <x-label for="name" value="Nombre" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <x-label for="email" value="Correo Electrónico" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        </div>

                        {{-- INICIO: Campo GÉNERO como Lista Desplegable --}}
                        <div class="mt-4">
                            <x-label for="genero" value="Género" />
                            
                            {{-- Usamos un select HTML estándar con clases de Tailwind (controlando errores de validación) --}}
                            <select id="genero" name="genero" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full @error('genero') border-red-500 @enderror" required>
                                <option value="" disabled selected>Selecciona tu género</option>
                                <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                <option value="Otro" {{ old('genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>

                            @error('genero')
                                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- FIN: Campo GÉNERO --}}

                        <div class="mt-4">
                            <x-label for="password" value="Contraseña" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        </div>

                        <div class="mt-4">
                            <x-label for="password_confirmation" value="Confirmar Contraseña" />
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-4">
                                <x-label for="terms">
                                    <div class="flex items-center">
                                        <x-checkbox name="terms" id="terms" required />
                                        <div class="ms-2">
                                            Acepto los <a target="_blank" href="{{ route('terms.show') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Términos de Servicio</a> y la <a target="_blank" href="{{ route('policy.show') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Política de Privacidad</a>
                                        </div>
                                    </div>
                                </x-label>
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                ¿Ya estás registrado?
                            </a>

                            <x-button class="ms-4">
                                Registrarse
                            </x-button>
                        </div>
                    </form>
                </x-authentication-card>
            </div>
        </div>
    </div>
</x-guest-layout>