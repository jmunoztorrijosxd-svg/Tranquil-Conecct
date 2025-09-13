<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * 
 * @property Collection|PermisoRol[] $permiso_rols
 * @property Collection|UsuarioRol[] $usuario_rols
 *
 * @package App\Models
 */
class Role extends Model
{
	protected $table = 'roles';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'descripcion'
	];

	public function permiso_rols()
	{
		return $this->hasMany(PermisoRol::class, 'rol_id');
	}

	public function usuario_rols()
	{
		return $this->hasMany(UsuarioRol::class, 'rol_id');
	}
}
