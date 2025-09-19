<div class="space-y-4">
    <div>
        <label for="name">Nombre</label>
        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="border rounded w-full">
        @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email">Correo</label>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="border rounded w-full">
        @error('email')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" class="border rounded w-full">
        @error('password')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" class="border rounded w-full">
    </div>
</div>
