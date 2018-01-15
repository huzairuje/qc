<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaksiTps extends Model
{
  public function users()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function tps()
  {
    return $this->belongsTo('App\Models\Tps');
  }

  public function kelurahan()
  {
    return $this->belongsTo('App\Models\Kelurahan');
  }

}
