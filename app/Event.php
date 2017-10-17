<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    public $primaryKey ='id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
	
    protected $fillable = [
        'nama_event',
        'provinsi',
        'kabupaten_kota',
        'dapil',
    ];
}
