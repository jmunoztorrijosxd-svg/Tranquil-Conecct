<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Desempeño
 * 
 * @property int $codigo_desempeño
 * @property string|null $descripcion
 * @property int $calificacion
 * @property Carbon|null $fecha_hora
 * @property string|null $condicion
 * @property int $id_usuario
 * @property int $codigo_apoyo
 * 
 * @property Usuario $usuario
 * @property Apoyo $apoyo
 *
 * @package App\Models
 */
class Desempeño extends Model
{
	protected $table = 'desempeño';
	protected $primaryKey = 'codigo_desempeño';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codigo_desempeño' => 'int',
		'calificacion' => 'int',
		'fecha_hora' => 'datetime',
		'id_usuario' => 'int',
		'codigo_apoyo' => 'int'
	];

	protected $fillable = [
		'descripcion',
		'calificacion',
		'fecha_hora',
		'condicion',
		'id_usuario',
		'codigo_apoyo'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'id_usuario');
	}

	public function apoyo()
	{
		return $this->belongsTo(Apoyo::class, 'codigo_apoyo');
	}
}
