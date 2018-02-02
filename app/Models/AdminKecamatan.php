<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminKecamatan extends Model
{
    protected $table = 'admin_kecamatan';

  protected $fillable = [
        'user_id','kecamatan_id', 'alamat', 'foto'
    ];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function kecamatan()
  {
    return $this->belongsTo('App\Models\Kecamatan');
  }

  public function userEvent()
  {
    return $this->belongsTo('App\Models\UserEvent');
  }
}
