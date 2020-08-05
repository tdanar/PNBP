<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Messaging
 * 
 * @property int $id
 * @property int|null $sender_id
 * @property int|null $receiver_id
 * @property string|null $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Messaging extends Model
{
	protected $table = 't_messaging';

	protected $casts = [
		'sender_id' => 'int',
		'receiver_id' => 'int'
	];

	protected $fillable = [
		'sender_id',
		'receiver_id',
		'message'
	];
}
