<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
  protected $table = 'absensi';
  public $primaryKey ='id';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $fillable = [
      'user_id',
      'status',
      'alasan',
      'user_replacement_id',
  ];
  protected $casts = [
                'status' => 'boolean',
                ];

  public function user()
  {
      return $this->belongsTo('App\Models\User');
  }
  public function userEvent()
  {
      return $this->belongsTo('App\Models\UserEvent');
  }
  public function tps()
  {
      return $this->belongsTo('App\Models\Tps');
  }
  public function event()
  {
      return $this->belongsTo('App\Models\Event');
  }

}
