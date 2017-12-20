<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DapilLokasi extends Model
{
  protected $table = 'dapil_lokasi';

  public function dapil()
  {
      return $this->belongsTo('App\Models\Dapil');
  }

  public function lokasi()
  {
      if($this->dapil->event->jenis == 2 && $this->dapil->event->tingkat == 3)
      {
          return $this->belongsTo('App\Models\Kecamatan', 'lokasi_id');
      }
      else if($this->dapil->event->jenis == 3 && $this->dapil->event->tingkat == 3)
      {
          return $this->belongsTo('App\Models\Kota', 'lokasi_id');
      }
      else if($this->dapil->event->jenis == 2 && $this->dapil->event->tingkat == 2)
      {
          return $this->belongsTo('App\Models\Kota', 'lokasi_id');
      }
      else if($this->dapil->event->jenis == 3 && $this->dapil->event->tingkat == 2)
      {
          return $this->belongsTo('App\Models\Provinsi', 'lokasi_id');
      }
  }
}
