<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
  protected $table = 'approval';
  public $primaryKey ='id';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  protected $fillable = [
    'user_id',
    'event_id',
    'kelurahan_id',
    'tps_id',
    'is_approved'
  ];
  protected $casts = [
                'is_approved' => 'boolean',
                ];

  public function user()
  {
      return $this->belongsTo('App\Models\User');
  }
  public function userEvent()
  {
      return $this->belongsTo('App\Models\UserEvent');
  }
  public function kelurahan()
	{
			return $this->belongsTo('App\Models\Kelurahan');
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
