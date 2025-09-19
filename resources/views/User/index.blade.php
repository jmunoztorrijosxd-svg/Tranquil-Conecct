<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="p-6">
        {{-- Mostrar mensaje de éxito --}}
        @if (session('success'))
            <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif

        {{-- Botón de nuevo usuario --}}
        <a href="{{ route('user.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">
            Nuevo
        </a>

        {{-- Tabla con DataTables --}}
        <div class="mt-6 bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
            <table id="employees" class="display w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td class="space-x-2">
                                {{-- Botón editar --}}
                                <a href="{{ route('user.edit', $u) }}" class="text-blue-600 hover:underline">Editar</a>

                                {{-- Botón eliminar --}}
                                <form action="{{ route('user.destroy', $u) }}" method="POST" style="display:inline"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

{{-- jQuery + DataTables (CDN) --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
$(function() {
    $('#employees').DataTable({
        pageLength: 20,
        dom: 'Bfrtip',
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
        },
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });
});
</script>
