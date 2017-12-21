<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
	protected $table = 'tps';
	public $primaryKey ='id';

		const CREATED_AT = 'created_at';
		const UPDATED_AT = 'updated_at';

		protected $fillable = [
				'nomor',
				'kelurahan_id',

		];


	public function kelurahan()
	{
			return $this->belongsTo('App\Models\Kelurahan');
	}

	public function suara()
	{
			return $this->hasMany('App\Models\Suara');
	}
}
