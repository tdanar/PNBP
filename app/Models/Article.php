<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * 
 * @property int $id
 * @property int|null $id_penulis
 * @property string|null $judul
 * @property string|null $sub_judul
 * @property string|null $cover
 * @property string|null $isi
 * @property string|null $link
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Article extends Model
{
	protected $table = 't_article';

	protected $casts = [
		'id_penulis' => 'int'
	];

	protected $fillable = [
		'id_penulis',
		'judul',
		'sub_judul',
		'cover',
		'isi',
		'link'
	];
}
