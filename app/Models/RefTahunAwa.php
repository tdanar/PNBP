<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RefTahunAwa
 * 
 * @property int $id
 * @property int $tahun
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class RefTahunAwa extends Model
{
	protected $table = 't_ref_tahun_awas';

	protected $casts = [
		'tahun' => 'int'
	];

	protected $fillable = [
		'tahun'
	];
}
