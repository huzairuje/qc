<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabulasi extends Model
{
	protected $table = 'tabulasi';
    public $primaryKey ='id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'dokumen',
        'provinsi_id',
        'kota_id',
        'kecamatan_id',
        'kelurahan_id',
        'data_suara',
				'event_id'
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }
}
