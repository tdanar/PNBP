<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RefKodTemuan
 * 
 * @property int $id
 * @property int|null $Id_up
 * @property int|null $id_up2
 * @property string|null $Kode
 * @property string|null $Deskripsi
 *
 * @package App\Models
 */
class RefKodTemuan extends Model
{
	protected $table = 't_ref_kod_temuan';
	public $timestamps = false;

	protected $casts = [
		'Id_up' => 'int',
		'id_up2' => 'int'
	];

	protected $fillable = [
		'Id_up',
		'id_up2',
		'Kode',
		'Deskripsi'
	];
}
