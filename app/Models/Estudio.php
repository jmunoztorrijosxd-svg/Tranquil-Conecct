<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estudio
 * 
 * @property int $id_estudios
 * @property int $usuario_id
 * 
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Estudio extends Model
{
	protected $table = 'estudios';
	protected $primaryKey = 'id_estudios';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_estudios' => 'int',
		'usuario_id' => 'int'
	];

	protected $fillable = [
		'usuario_id'
	];

	public function usuario()
	{
		return $this->belongsTo(Usuario::class);
	}
}
