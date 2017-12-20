<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
  protected $table = 'kelurahan';

  public function kecamatan()
  {
      return $this->belongsTo('App\Models\Kecamatan');
  }

  public function tps()
  {
      return $this->hasMany('App\Models\Tps');
  }
}
