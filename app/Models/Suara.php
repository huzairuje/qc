<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suara extends Model
{
		protected $table = 'suara';

		public function tps()
		{
				return $this->belongsTo('App\Models\Tps');
		}

		public function calon()
		{
				return $this->belongsTo('App\Models\Calon');
		}
}
