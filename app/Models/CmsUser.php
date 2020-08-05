<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CmsUser
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $photo
 * @property string|null $email
 * @property string|null $hp
 * @property string|null $eselon
 * @property string|null $jabatan
 * @property string|null $username
 * @property string|null $password
 * @property int|null $id_cms_privileges
 * @property int|null $id_kode_unit
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $status
 * @property string|null $session_id
 * @property string|null $ip_address_login
 * @property string|null $token_reset
 *
 * @package App\Models
 */
class CmsUser extends Model
{
	protected $table = 'cms_users';

	protected $casts = [
		'id_cms_privileges' => 'int',
		'id_kode_unit' => 'int'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'photo',
		'email',
		'hp',
		'eselon',
		'jabatan',
		'username',
		'password',
		'id_cms_privileges',
		'id_kode_unit',
		'status',
		'session_id',
		'ip_address_login',
		'token_reset'
    ];

    public function Unit()
    {
        return $this->hasOne(RefUnit::class,'id','id_kode_unit');
    }
}
