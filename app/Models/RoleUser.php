<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }
}
