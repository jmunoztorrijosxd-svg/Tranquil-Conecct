<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Grupo
 * 
 * @property int $id_grupo
 * @property string $nombre
 * @property int $num_miembros
 * @property string $motivo_salida
 * 
 * @property Collection|ForoSocial[] $foro_socials
 * @property Collection|Pertenece[] $perteneces
 *
 * @package App\Models
 */
class Grupo extends Model
{
	protected $table = 'grupo';
	protected $primaryKey = 'id_grupo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_grupo' => 'int',
		'num_miembros' => 'int'
	];

	protected $fillable = [
		'nombre',
		'num_miembros',
		'motivo_salida'
	];

	public function foro_socials()
	{
		return $this->hasMany(ForoSocial::class, 'grupo_codigo_grupo');
	}

	public function perteneces()
	{
		return $this->hasMany(Pertenece::class, 'codigo_grupo');
	}
}
