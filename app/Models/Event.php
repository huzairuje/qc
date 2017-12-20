<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    public $primaryKey ='id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'nama',
        'jenis',
        'tingkat',
        'lokasi',
        'tahun',
        'expired',
    ];

    public function dapil()
    {
        return $this->hasMany('App\Models\Dapil');
    }
}
