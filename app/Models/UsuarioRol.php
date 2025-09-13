<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioRol
 * 
 * @property int $usuario_id
 * @property int $rol_id
 * 
 * @property Usuario $usuario
 * @property Role $role
 *
 * @package App\Models
 */
class UsuarioRol extends Model
{
	protected $table = 'usuario_rol';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'usuario_id' => 'int',
		'rol_id' => 'int'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'rol_id');
	}
}
