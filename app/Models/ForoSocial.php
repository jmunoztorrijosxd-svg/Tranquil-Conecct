<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ForoSocial
 * 
 * @property int $codigo_foro
 * @property string|null $estado_mensaje
 * @property string|null $reacciones
 * @property string|null $foto_perfil
 * @property string|null $comentarios
 * @property string|null $enlaces
 * @property int $grupo_codigo_grupo
 * 
 * @property Grupo $grupo
 * @property Collection|Debate[] $debates
 *
 * @package App\Models
 */
class ForoSocial extends Model
{
	protected $table = 'foro_social';
	protected $primaryKey = 'codigo_foro';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codigo_foro' => 'int',
		'grupo_codigo_grupo' => 'int'
	];

	protected $fillable = [
		'estado_mensaje',
		'reacciones',
		'foto_perfil',
		'comentarios',
		'enlaces',
		'grupo_codigo_grupo'
	];

	public function grupo()
	{
		return $this->belongsTo(Grupo::class, 'grupo_codigo_grupo');
	}

	public function comentarios()
	{
		return $this->hasMany(Comentario::class, 'foro_codigo_foro');
	}

	public function debates()
	{
		return $this->hasMany(Debate::class, 'foro_codigo_foro');
	}

	public function enlaces()
	{
		return $this->hasMany(Enlace::class, 'foro_codigo_foro');
	}

	public function reacciones()
	{
		return $this->hasMany(Reaccione::class, 'foro_codigo_foro');
	}
}
