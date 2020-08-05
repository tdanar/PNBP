<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RefUnit
 * 
 * @property int $id
 * @property string|null $unit
 * @property string|null $u_base
 * @property string|null $p_base
 *
 * @package App\Models
 */
class RefUnit extends Model
{
	protected $table = 't_ref_unit';
	public $timestamps = false;

	protected $fillable = [
		'unit',
		'u_base',
		'p_base'
	];
}
