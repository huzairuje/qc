<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';

    protected $fillable = [
        'nama'
    ];

    public function kecamatan()
    {
        return $this->belongsTo('App\Kecamatan');
    }

    public function tps()
    {
        return $this->hasMany('App\Tps');
    }
}
