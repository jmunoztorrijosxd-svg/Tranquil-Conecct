<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use Illuminate\Validation\ValidationException;

class GrupoController extends Controller
{
    // Método para la API que devuelve datos JSON. 
    public function data()
    {
        try {
            // Buscamos todos los grupos. Esto debería funcionar ahora que $table='grupo' está definido en el modelo.
            $grupos = Grupo::all();
            return response()->json($grupos);
        } catch (\Exception $e) {
            // Devolvemos un error 500 si hay problemas con la BD o el modelo.
            return response()->json(['error' => 'Error al cargar los datos de grupos.', 'details' => $e->getMessage()], 500);
        }
    }

    // Método para CREAR un grupo, recibe la Request.
    // Corresponde a la ruta POST /api/grupos
    public function store(Request $request) // ✅ CORRECCIÓN CLAVE: Inyección de dependencia de Request
    {
        // 1. Validación de datos. Laravel devolverá automáticamente un JSON 422 si falla.
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'num_miembros' => 'required|integer|min:1',
                // 'motivo_salida' no es requerido si siempre lo rellenamos
            ]);
        } catch (ValidationException $e) {
             // Si falla la validación, devolvemos los errores en JSON (código 422)
            return response()->json([
                'message' => 'Los datos proporcionados no son válidos.',
                'errors' => $e->errors()
            ], 422);
        }

        // 2. Crear el grupo con los datos validados más el campo por defecto.
        try {
            $grupo = Grupo::create([
                'nombre' => $validatedData['nombre'],
                'num_miembros' => $validatedData['num_miembros'],
                'motivo_salida' => 'Ninguno' // Valor por defecto
            ]);
            
            // 3. Devolver una respuesta JSON de éxito (código 201 Created)
            return response()->json([
                'message' => 'Grupo creado con éxito.',
                'grupo' => $grupo
            ], 201);

        } catch (\Exception $e) {
            // Error si falla la inserción en la BD por alguna otra razón.
            return response()->json(['error' => 'Fallo al intentar guardar el grupo.', 'details' => $e->getMessage()], 500);
        }
    }
}