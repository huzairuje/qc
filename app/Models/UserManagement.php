<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserManagement extends Model
{
    public function users()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function event()
    {
    	return $this->belongsTo('App\Models\Event');
    }
}
