<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pengumuman
 * 
 * @property int $id
 * @property int|null $id_user
 * @property string|null $pengumuman
 * @property string|null $link
 * @property bool $show
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Pengumuman extends Model
{
	protected $table = 't_pengumuman';

	protected $casts = [
		'id_user' => 'int',
		'show' => 'bool'
	];

	protected $fillable = [
		'id_user',
		'pengumuman',
		'link',
		'show'
	];
}
