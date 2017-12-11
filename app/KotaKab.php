<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KotaKab extends Model
{
	protected $table = 'kota_kabupaten';

    protected $fillable = [
        'nama'
    ];

    public function provinsi()
    {
        return $this->belongsTo('App\Provinsi');
    }

    public function kecamatan()
    {
        return $this->hasMany('App\Kecamatan', 'kota_kabupaten_id', 'id');
    }
}
