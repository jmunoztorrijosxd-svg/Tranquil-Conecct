<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $correo
 * @property int $telefono
 * @property string $genero
 * @property string|null $experiencia
 * 
 * @property Collection|Agenda[] $agendas
 * @property Collection|Desempeño[] $desempeños
 * @property Collection|Estudio[] $estudios
 * @property Collection|Pertenece[] $perteneces
 * @property Collection|UsuarioRol[] $usuario_rols
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuario';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'telefono' => 'int'
	];

	protected $fillable = [
		'nombre',
		'correo',
		'telefono',
		'genero',
		'experiencia'
	];

	public function agendas()
	{
		return $this->hasMany(Agenda::class, 'usuario_usuario_elige');
	}

	public function desempeños()
	{
		return $this->hasMany(Desempeño::class, 'id_usuario');
	}

	public function estudios()
	{
		return $this->hasMany(Estudio::class);
	}

	public function perteneces()
	{
		return $this->hasMany(Pertenece::class, 'id_usuario');
	}

	public function usuario_rols()
	{
		return $this->hasMany(UsuarioRol::class);
	}
}
