<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LapAwasTemuan
 *
 * @property int $id
 * @property int $id_lap
 * @property string|null $judul
 * @property int|null $id_kod_temuan
 * @property string|null $kondisi
 * @property int $id_mata_uang
 * @property float|null $nilai_uang
 * @property string|null $lokasi
 * @property int|null $id_kod_sebab
 * @property string|null $sebab
 * @property string|null $akibat
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property LapAwa $lap_awa
 * @property Collection|LapAwasRekomend[] $lap_awas_rekomends
 *
 * @package App\Models
 */
class LapAwasTemuan extends Model
{
	protected $table = 't_lap_awas_temuan';

	protected $casts = [
		'id_lap' => 'int',
		'id_kod_temuan' => 'int',
		'id_mata_uang' => 'int',
		'nilai_uang' => 'float',
		'id_kod_sebab' => 'int'
	];

	protected $fillable = [
		'id_lap',
		'judul',
		'id_kod_temuan',
		'kondisi',
		'id_mata_uang',
		'nilai_uang',
		'lokasi',
		'id_kod_sebab',
		'sebab',
		'akibat'
	];

	public function lap_awa()
	{
		return $this->belongsTo(LapAwa::class, 'id_lap');
	}

	public function lap_awas_rekomends()
	{
		return $this->hasMany(LapAwasRekomend::class, 'id_temuan');
    }

    public function id_kod_temuan(){
        return $this->hasOne(RefKodTemuan::class,'id','id_kod_temuan');
    }
    public function id_mata_uang(){
        return $this->hasOne(RefMatauang::class,'id','id_mata_uang');
    }

    public function id_kod_sebab(){
        return $this->hasOne(RefKodTemuan::class,'id','id_kod_sebab');
    }
}
