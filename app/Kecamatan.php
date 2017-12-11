<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = [
        'nama'
    ];

    public function kotKab()
    {
        return $this->belongsTo('App\KotaKab', 'kota_kabupaten_id');
    }

    public function kelurahan()
    {
        return $this->hasMany('App\Kelurahan');
    }
}
