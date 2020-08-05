<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RefKodSebab
 * 
 * @property int $id
 * @property int|null $Id_up_sebab
 * @property string|null $Kode
 * @property string|null $Deskripsi
 *
 * @package App\Models
 */
class RefKodSebab extends Model
{
	protected $table = 't_ref_kod_sebab';
	public $timestamps = false;

	protected $casts = [
		'Id_up_sebab' => 'int'
	];

	protected $fillable = [
		'Id_up_sebab',
		'Kode',
		'Deskripsi'
	];
}
