<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class t_diag_pnbp_jeni extends Model
{
    protected $fillable = [
		'komp_pnbp',
		'tahun',
		'nominal',
		'created_at',
		'updated_at'
	];
}
