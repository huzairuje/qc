<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tabulasi extends Model
{
	protected $table = 'tabulasi';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
	
    protected $fillable = [
        'dokumen_id',
        'provinsi_id',
        'kota_kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
        'data_suara'
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class,'nama_provinsi','id');
    }

    public function kota_kabupaten()
    {
        return $this->belongsTo(KotaKab::class,'nama','id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class,'nama','id');
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class,'nama','id');
    }
}
