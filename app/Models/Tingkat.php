<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
  protected $table = 'tingkat';

  public function event()
  {
      return $this->hasMany('App\Models\Event');
  }
}
