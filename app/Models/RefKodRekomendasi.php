<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RefKodRekomendasi
 * 
 * @property int $id
 * @property int|null $Id_up
 * @property string|null $Kode
 * @property string|null $Deskripsi
 *
 * @package App\Models
 */
class RefKodRekomendasi extends Model
{
	protected $table = 't_ref_kod_rekomendasi';
	public $timestamps = false;

	protected $casts = [
		'Id_up' => 'int'
	];

	protected $fillable = [
		'Id_up',
		'Kode',
		'Deskripsi'
	];
}
