<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Grupo
 * @property int $id_grupo
 * @property string $nombre
 * @property int $num_miembros
 * @property string $motivo_salida
 * @property string $descripcion // <- Nuevo atributo añadido
 * @property Collection|Pertenece[] $perteneces
 *
 * @package App\Models
 */
class Grupo extends Model
{
    // Usamos HasFactory para poder usar Grupo::factory()
    use HasFactory;

    // ✅ CORRECCIÓN CLAVE: Le decimos a Laravel que la tabla se llama 'grupo' (singular), 
    // y no 'grupos' (plural), para evitar el error 1146 (Table not found).
    protected $table = 'grupo';
    protected $primaryKey = 'id_grupo';
    
    // ✅ CORRECTO: La primary key es auto-incremental.
    public $incrementing = true; 
    public $timestamps = false; // Asumimos que no tienes created_at/updated_at

    protected $casts = [
        'id_grupo' => 'int',
        'num_miembros' => 'int'
    ];

    // ✅ CRÍTICO PARA EL GUARDADO AJAX: Se añade 'descripcion' a los campos asignables masivamente.
    protected $fillable = [
        'nombre',
        'num_miembros',
        'motivo_salida',
        'descripcion' // <- ¡Añadido aquí!
    ];

    public function perteneces()
    {
        // Simplificamos la referencia a Pertenece::class. 
        // Asumimos que Pertenece.php está en el mismo namespace (App\Models).
        return $this->hasMany(Pertenece::class, 'codigo_grupo');
    }
}