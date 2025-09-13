<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PermisoRol
 * 
 * @property int $rol_id
 * @property int $permiso_id
 * 
 * @property Role $role
 * @property Permiso $permiso
 *
 * @package App\Models
 */
class PermisoRol extends Model
{
	protected $table = 'permiso_rol';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'rol_id' => 'int',
		'permiso_id' => 'int'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'rol_id');
	}

	public function permiso()
	{
		return $this->belongsTo(Permiso::class);
	}
}
