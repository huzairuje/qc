<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis';

    public function event()
    {
        return $this->hasMany('App\Models\Event');
    }
}
