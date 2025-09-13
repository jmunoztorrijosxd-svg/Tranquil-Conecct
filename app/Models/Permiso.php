<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Permiso
 * 
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * 
 * @property Collection|PermisoRol[] $permiso_rols
 *
 * @package App\Models
 */
class Permiso extends Model
{
	protected $table = 'permisos';
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
		return $this->hasMany(PermisoRol::class);
	}
}
