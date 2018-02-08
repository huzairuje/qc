<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TpsFoto extends Model
{
  public $timestamps = false;
  protected $table = 'tps_foto';

  protected $fillable = [
        'tps_id', 'foto', 'event_id'
    ];
}
