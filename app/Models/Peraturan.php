<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Peraturan
 * 
 * @property int $id
 * @property int|null $id_user
 * @property string|null $judul
 * @property string|null $uraian
 * @property string|null $file
 * @property string|null $link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Peraturan extends Model
{
	protected $table = 't_peraturan';

	protected $casts = [
		'id_user' => 'int'
	];

	protected $fillable = [
		'id_user',
		'judul',
		'uraian',
		'file',
		'link'
	];
}
