<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RefMatauang
 * 
 * @property int $id
 * @property string $kode
 * @property string $deskripsi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class RefMatauang extends Model
{
	protected $table = 't_ref_matauang';

	protected $fillable = [
		'kode',
		'deskripsi'
	];
}
