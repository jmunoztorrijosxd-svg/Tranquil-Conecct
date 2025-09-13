<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pago
 * 
 * @property int $codigo
 * @property int $telefono
 * @property string $metodo
 * @property string $estado
 * @property Carbon $fecha
 * @property int $monto
 * @property string $moneda
 * @property int $codigo_agenda
 * 
 * @property Agenda $agenda
 *
 * @package App\Models
 */
class Pago extends Model
{
	protected $table = 'pago';
	protected $primaryKey = 'codigo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codigo' => 'int',
		'telefono' => 'int',
		'fecha' => 'datetime',
		'monto' => 'int',
		'codigo_agenda' => 'int'
	];

	protected $fillable = [
		'telefono',
		'metodo',
		'estado',
		'fecha',
		'monto',
		'moneda',
		'codigo_agenda'
	];

	public function agenda()
	{
		return $this->belongsTo(Agenda::class, 'codigo_agenda');
	}
}
