<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminProvinsi extends Model
{
    protected $table = 'admin_provinsi';

  protected $fillable = [
        'user_id','provinsi_id', 'alamat', 'foto'
    ];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function provinsi()
  {
    return $this->belongsTo('App\Models\Provinsi');
  }

  public function userEvent()
  {
    return $this->belongsTo('App\Models\UserEvent');
  }
}
