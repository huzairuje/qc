<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
  protected $table = 'kota';

  public function provinsi()
  {
      return $this->belongsTo('App\Models\Provinsi');
  }

  public function kecamatan()
  {
      return $this->hasMany('App\Models\Kecamatan');
  }

  public function dapil_lokasi()
  {
      return $this->hasMany('App\Models\DapilLokasi', 'lokasi_id');
  }
}
