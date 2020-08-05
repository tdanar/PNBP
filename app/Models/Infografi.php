<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Infografi
 * 
 * @property int $id
 * @property int|null $id_user
 * @property string|null $judul
 * @property string|null $cover
 * @property string|null $file
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Infografi extends Model
{
	protected $table = 't_infografis';

	protected $casts = [
		'id_user' => 'int'
	];

	protected $fillable = [
		'id_user',
		'judul',
		'cover',
		'file'
	];
}
