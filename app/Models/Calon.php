<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
  protected $table = 'calon';
  public $primaryKey ='id';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $fillable = [
      'dapil_id',
      'tipe',
      'partai_id',
      'nomor',
      'event_id',
      'nama',
      'has_wakil',
      'alamat',
      'no_telpon',
      'email',
      'foto',
  ];

  public function dapil()
  {
      return $this->belongsTo('App\Models\Dapil');
  }

  public function partai()
  {
      return $this->belongsTo('App\Models\Partai');
  }

  public function wakil()
  {
      return $this->hasMany('App\Models\Wakil');
  }

  public function suara()
  {
      return $this->hasMany('App\Models\Suara');
  }

}
