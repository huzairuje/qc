<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminKota extends Model
{
    protected $table = 'admin_kota';

  protected $fillable = [
        'user_id','kota_id', 'alamat', 'foto'
    ];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function kota()
  {
    return $this->belongsTo('App\Models\Kota');
  }

  public function userEvent()
  {
    return $this->belongsTo('App\Models\UserEvent');
  }
}
