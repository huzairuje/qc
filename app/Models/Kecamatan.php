<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = [
        'nama'
    ];

    public function kota()
    {
        return $this->belongsTo('App\Models\Kota');
    }

    public function kelurahan()
    {
        return $this->hasMany('App\Kelurahan');
    }
}
