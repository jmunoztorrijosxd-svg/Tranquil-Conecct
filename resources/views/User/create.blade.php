<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Crear Usuario</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            @include('User._form', ['user' => null])
            <button class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
            <a href="{{ route('user.index') }}" class="ml-2 px-4 py-2 border rounded">Cancelar</a>
        </form>
    </div>
</x-app-layout>
