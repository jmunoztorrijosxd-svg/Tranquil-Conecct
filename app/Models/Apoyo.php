<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Apoyo
 * 
 * @property int $codigo_apoyo
 * @property string|null $descripcion
 * @property string|null $enlace
 * @property string $permisos
 * @property Carbon|null $fecha
 * @property string|null $reacciones
 * @property string|null $comentarios
 * @property string|null $historial
 * @property string $formato
 * @property string $op_descarga
 * @property int|null $duracion
 * @property int $codigo_agenda
 * 
 * @property Agenda $agenda
 * @property Collection|Desempeño[] $desempeños
 *
 * @package App\Models
 */
class Apoyo extends Model
{
	protected $table = 'apoyo';
	protected $primaryKey = 'codigo_apoyo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codigo_apoyo' => 'int',
		'fecha' => 'datetime',
		'duracion' => 'int',
		'codigo_agenda' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'enlace',
		'permisos',
		'fecha',
		'reacciones',
		'comentarios',
		'historial',
		'formato',
		'op_descarga',
		'duracion',
		'codigo_agenda'
	];

	public function agenda()
	{
		return $this->belongsTo(Agenda::class, 'codigo_agenda');
	}

	public function desempeños()
	{
		return $this->hasMany(Desempeño::class, 'codigo_apoyo');
	}
}
