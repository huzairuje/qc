<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
	protected $table = 'provinsi';

	public function kota()
	{
			return $this->hasMany('App\Models\Kota');
	}
}
