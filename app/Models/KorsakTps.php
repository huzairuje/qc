<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KorsakTps extends Model
{
   public $table = 'korsak_tps';

  public $fillable = [
        'user_id', 'tps_id','kelurahan_id', 'alamat', 'foto'
    ];

  public function user()
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

  public function userEvent()
  {
    return $this->belongsTo('App\Models\UserEvent');
  }
}
