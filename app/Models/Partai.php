<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partai extends Model
{
    protected $table = 'partai';

    protected $fillable = ['nama'];

    public function calon()
    {
        return $this->hasMany('App\Models\Calon');
    }
}
