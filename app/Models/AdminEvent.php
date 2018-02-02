<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminEvent extends Model
{
    protected $table = 'admin_event';

  protected $fillable = [
        'user_id', 'alamat', 'foto'
    ];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function userEvent()
  {
    return $this->belongsTo('App\Models\UserEvent');
  }
}
