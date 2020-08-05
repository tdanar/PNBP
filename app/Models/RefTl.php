<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RefTl
 * 
 * @property int $id
 * @property string|null $deskripsi
 *
 * @package App\Models
 */
class RefTl extends Model
{
	protected $table = 't_ref_tl';
	public $timestamps = false;

	protected $fillable = [
		'deskripsi'
	];
}
