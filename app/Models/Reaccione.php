<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reaccione
 * 
 * @property int $codigo
 * @property int $foro_codigo_foro
 * 
 * @property ForoSocial $foro_social
 *
 * @package App\Models
 */
class Reaccione extends Model
{
	protected $table = 'reacciones';
	protected $primaryKey = 'codigo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'codigo' => 'int',
		'foro_codigo_foro' => 'int'
	];

	protected $fillable = [
		'foro_codigo_foro'
	];

	public function foro_social()
	{
		return $this->belongsTo(ForoSocial::class, 'foro_codigo_foro');
	}
}
