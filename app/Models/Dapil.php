<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dapil extends Model
{
  protected $table = 'dapil';
  protected $fillable = ['event_id', 'nama'];
  protected $listLokasiId;

  public function event()
  {
      return $this->belongsTo('App\Models\Event');
  }

  public function dapil_lokasi()
  {
      return $this->hasMany('App\Models\DapilLokasi');
  }

  public function calon()
  {
      return $this->hasMany('App\Models\Calon');
  }
}
