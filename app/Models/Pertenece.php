<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pertenece
 * 
 * @property int $id_usuario
 * @property int $codigo_grupo
 * 
 * @property Usuario $usuario
 * @property Grupo $grupo
 *
 * @package App\Models
 */
class Pertenece extends Model
{
	protected $table = 'pertenece';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'codigo_grupo' => 'int'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

	public function grupo()
	{
		return $this->belongsTo(Grupo::class, 'codigo_grupo');
	}
}
