<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Agenda
 * 
 * @property int $codigo_agenda
 * @property string|null $correo
 * @property Carbon|null $fecha_hora
 * @property int $telefono
 * @property int $id_usuario_solicita
 * @property int $usuario_usuario_elige
 * 
 * @property Usuario $usuario
 * @property Collection|Apoyo[] $apoyos
 * @property Collection|Pago[] $pagos
 *
 * @package App\Models
 */
class Agenda extends Model
{
	protected $table = 'agenda';
	protected $primaryKey = 'codigo_agenda';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codigo_agenda' => 'int',
		'fecha_hora' => 'datetime',
		'telefono' => 'int',
		'id_usuario_solicita' => 'int',
		'usuario_usuario_elige' => 'int'
	];

	protected $fillable = [
		'correo',
		'fecha_hora',
		'telefono',
		'id_usuario_solicita',
		'usuario_usuario_elige'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'usuario_usuario_elige');
	}

	public function apoyos()
	{
		return $this->hasMany(Apoyo::class, 'codigo_agenda');
	}

	public function pagos()
	{
		return $this->hasMany(Pago::class, 'codigo_agenda');
	}
}
