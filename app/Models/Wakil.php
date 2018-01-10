<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wakil extends Model
{
  protected $table = 'wakil';
  public $primaryKey ='id';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $fillable = [
      'calon_id',
      'nama',
      'alamat',
      'no_telpon',
      'email',
      'foto',
  ];

  public function calon()
  {
      return $this->belongsTo('App\Models\Calon');
  }

}
