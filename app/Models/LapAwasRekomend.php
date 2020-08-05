<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LapAwasRekomend
 *
 * @property int $id
 * @property int $id_temuan
 * @property string|null $rekomendasi
 * @property int|null $id_kod_rekomendasi
 * @property Carbon|null $tgl_tl
 * @property string|null $status_tl
 * @property int|null $id_kod_tl
 * @property string|null $tl
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property LapAwasTemuan $lap_awas_temuan
 * @property Collection|LapAwasTlanjut[] $lap_awas_tlanjuts
 *
 * @package App\Models
 */
class LapAwasRekomend extends Model
{
	protected $table = 't_lap_awas_rekomend';

	protected $casts = [
		'id_temuan' => 'int',
		'id_kod_rekomendasi' => 'int',
		'id_kod_tl' => 'int'
	];

	protected $dates = [
		'tgl_tl'
	];

	protected $fillable = [
		'id_temuan',
		'rekomendasi',
		'id_kod_rekomendasi',
		'tgl_tl',
		'status_tl',
		'id_kod_tl',
		'tl'
	];

	public function lap_awas_temuan()
	{
		return $this->belongsTo(LapAwasTemuan::class, 'id_temuan');
    }

    public function id_kod_rekomendasi()
	{
		return $this->hasOne(RefKodRekomendasi::class, 'id','id_kod_rekomendasi');
    }

    public function id_kod_tl()
	{
		return $this->hasOne(RefTl::class, 'id','id_kod_tl');
    }

	public function lap_awas_tlanjuts()
	{
		return $this->hasMany(LapAwasTlanjut::class, 'id_rekomendasi');
	}
}
