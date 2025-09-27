<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class psicologo extends Model
{
    use HasFactory;

    // 1. Especificar el nombre de la tabla
    protected $table = 'psicologo'; 

    // 2. Especificar la clave primaria
    protected $primaryKey = 'psicologo_id';

    // 3. Opcional: Desactivar las marcas de tiempo (created_at y updated_at)
    // Si tu tabla no tiene estas columnas, debes incluir esta línea.
    public $timestamps = false; 

    // 4. Habilitar la Asignación Masiva (Mass Assignment)
    // Esto es NECESARIO si planeas crear registros usando create()
    protected $fillable = [
        'nombre',
        'especialidad',
        'email',
    ];
}