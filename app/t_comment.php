<?php

namespace App;

use App\Models\LapAwa;
use Illuminate\Database\Eloquent\Model;

class t_comment extends Model
{
    protected $fillable = [
        'lap_id',
        'user_id',
        'comment',
        'accept'
    ];


}
