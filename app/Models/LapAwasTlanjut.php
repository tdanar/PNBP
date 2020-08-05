<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LapAwasTlanjut
 * 
 * @property int $id
 * @property int|null $id_rekomendasi
 * @property Carbon $tgl
 * @property string $progress
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property LapAwasRekomend $lap_awas_rekomend
 *
 * @package App\Models
 */
class LapAwasTlanjut extends Model
{
	protected $table = 't_lap_awas_tlanjut';

	protected $casts = [
		'id_rekomendasi' => 'int'
	];

	protected $dates = [
		'tgl'
	];

	protected $fillable = [
		'id_rekomendasi',
		'tgl',
		'progress',
		'status'
	];

	public function lap_awas_rekomend()
	{
		return $this->belongsTo(LapAwasRekomend::class, 'id_rekomendasi');
	}
}
