<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use Illuminate\Validation\ValidationException;

class GrupoController extends Controller
{
    /**
     * Obtener todos los grupos (API).
     */
    public function data()
    {
        try {
            $grupos = Grupo::all();
            return response()->json($grupos);
        } catch (\Exception $e) {
            \Log::error("Error al cargar grupos: " . $e->getMessage());
            return response()->json([
                'error' => 'Error al cargar los datos de grupos.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear un grupo (API).
     */
    public function store(Request $request)
    {
        try {
            // 1. Validación de datos
            $validatedData = $request->validate([
                'nombre'       => 'required|string|max:255|unique:grupos,nombre',
                'descripcion'  => 'nullable|string|max:255', // <-- ya estaba bien
                'num_miembros' => 'required|integer|min:1',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Los datos proporcionados no son válidos.',
                'errors'  => $e->errors()
            ], 422);
        }

        try {
            // 2. Crear el grupo
            $grupo = Grupo::create([
                'nombre'        => $validatedData['nombre'],
                'descripcion'   => $validatedData['descripcion'] ?? null,
                'num_miembros'  => $validatedData['num_miembros'],
                'motivo_salida' => 'Ninguno'
            ]);

            return response()->json([
                'message' => 'Grupo creado con éxito.',
                'grupo'   => $grupo
            ], 201);
        } catch (\Exception $e) {
            \Log::error("Error al crear grupo: " . $e->getMessage());
            return response()->json([
                'error'   => 'Fallo al intentar guardar el grupo.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
