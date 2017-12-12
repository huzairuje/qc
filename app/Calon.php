<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{

    public function kelurahan()
    {
        return $this->belongsTo('App\Partai');
    }

    public function suara()
    {
        return $this->hasMany('App\Suara');
    }
}
