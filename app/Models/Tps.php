<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
	protected $table = 'tps';

	public function kelurahan()
	{
			return $this->belongsTo('App\Models\Kelurahan');
	}

	public function suara()
	{
			return $this->hasMany('App\Models\Suara');
	}
}
