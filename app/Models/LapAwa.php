<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LapAwa
 *
 * @property int $id
 * @property int|null $id_user
 * @property int|null $id_status_kirim
 * @property int|null $tahun
 * @property string $no_lap
 * @property Carbon|null $tanggal
 * @property string|null $nama_giat_was
 * @property int|null $thn_mulai
 * @property int|null $thn_usai
 * @property int|null $id_jenis_was
 * @property string|null $filename
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|LapAwasTemuan[] $lap_awas_temuans
 *
 * @package App\Models
 */
class LapAwa extends Model
{
	protected $table = 't_lap_awas';

	protected $casts = [
		'id_user' => 'int',
		'id_status_kirim' => 'int',
		'tahun' => 'int',
		'thn_mulai' => 'int',
		'thn_usai' => 'int',
		'id_jenis_was' => 'int'
	];

	protected $dates = [
		'tanggal'
	];

	protected $fillable = [
		'id_user',
		'id_status_kirim',
		'tahun',
		'no_lap',
		'tanggal',
		'nama_giat_was',
		'thn_mulai',
		'thn_usai',
		'id_jenis_was',
		'filename'
	];

	public function lap_awas_temuans()
	{
		return $this->hasMany(LapAwasTemuan::class, 'id_lap');
    }

    public function id_user()
    {
        return $this->hasOne(CmsUser::class,'id','id_user');
    }

    public function id_jenis_was()
    {
        return $this->hasOne(RefJenisAwa::class,'id','id_jenis_was');
    }
}
