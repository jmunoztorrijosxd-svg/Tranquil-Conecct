<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-6 text-gray-700 border-b pb-2">
                    Resumen Rápido de Tranquil Connect
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="p-6 bg-blue-100 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                        <div class="text-3xl font-bold text-blue-600">
                            15
                        </div>
                        <div class="mt-2 text-lg font-semibold text-blue-800">Grupos Activos</div>
                        <p class="text-sm text-blue-700 mt-1">
                            Administra la lista de grupos creados y únete a nuevos.
                        </p>
                        <a href="{{ url('/grupos') }}" class="text-sm text-blue-500 hover:text-blue-700 mt-3 inline-block font-medium">
                            Ir a Grupos &rarr;
                        </a>
                    </div>

                    <div class="p-6 bg-green-100 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                        <div class="text-3xl font-bold text-green-600">
                            3
                        </div>
                        <div class="mt-2 text-lg font-semibold text-green-800">Citas Pendientes</div>
                        <p class="text-sm text-green-700 mt-1">
                            Revisa las citas agendadas con terapeutas.
                        </p>
                        <a href="{{ url('/agendar') }}" class="text-sm text-green-500 hover:text-green-700 mt-3 inline-block font-medium">
                            Ir a Agendar &rarr;
                        </a>
                    </div>

                    <div class="p-6 bg-yellow-100 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                        <div class="text-3xl font-bold text-yellow-600">
                            120
                        </div>
                        <div class="mt-2 text-lg font-semibold text-yellow-800">Usuarios en la Comunidad</div>
                        <p class="text-sm text-yellow-700 mt-1">
                            Panel de gestión y registro de nuevos usuarios.
                        </p>
                        <a href="{{ url('/usuarios') }}" class="text-sm text-yellow-500 hover:text-yellow-700 mt-3 inline-block font-medium">
                            Ir a Usuarios &rarr;
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>