<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserManagement extends Model
{
    public function Users()
    {
    	return $this->belongsTo('App\Models\User');
    }
}
