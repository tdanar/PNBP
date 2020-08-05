<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RefJenisAwa
 * 
 * @property int $id
 * @property string|null $jenis_awas
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class RefJenisAwa extends Model
{
	protected $table = 't_ref_jenis_awas';

	protected $fillable = [
		'jenis_awas'
	];
}
